<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            abort(403, 'Access Denied');
        }
        $posts = Post::latest()->take(5)->get();
        Log::info('Latest sliders:', $posts->toArray());
        $sliders = Slider::latest()->get();

        return view('dashboard.slider.index', compact('sliders'));
    }
    public function latest()
    {
        $latestPosts = Post::latest()->take(5)->get();
        return response()->json($latestPosts);
    }

    public function create()
    {
        $posts = Post::latest()->take(5)->get();
        return view('dashboard.slider.create', compact('posts'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            Log::info('Request data:', $validatedData); // Debugging log

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('slider_images', 'public');
                $validatedData['image'] = $imagePath;
            }

            // Save to database
            $slider = Slider::create($validatedData);
            Log::info('Slider berhasil dibuat:', $slider->toArray());

            return redirect()->route('dashboard.slider.index')->with('success', 'Slider berhasil ditambahkan!')->withErrors(['error' => 'Gagal menyimpan slider.']);
        } catch (\Exception $e) {
            Log::error('Gagal membuat slider: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan slider.']);
        }
    }

    public function edit($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return abort(404); // If data not found, return 404 error
        }

        return view('dashboard.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slider_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $slider->update($validatedData);

        return redirect()->route('dashboard.slider.index')->with('update', 'Slider berhasil diperbarui!')->withErrors(['error' => 'Gagal memperbarui slider.']);
    }

    public function destroy($id)
    {
        Slider::destroy($id);
        return redirect()->route('dashboard.slider.index')->with('delete', 'Slider berhasil dihapus')->withErrors(['error' => 'Gagal menghapus slider.']);
    }

    /**
     * Display the home view with sliders.
     */
    public function home()
    {
        $sliders = Slider::latest()->get();
        return view('home', compact('sliders'));
    }
}
