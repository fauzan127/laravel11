<nav class="bg-gray-800" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
              <x-nav-link href="/posts" :active="request()->is('posts')">Blog</x-nav-link>
              <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
              <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
            </div>
          </div>
        </div>

        <div class="flex items-center">
          <!-- Account Button (Both Mobile and Desktop) -->
          <div>
            @if(Auth::check())
            <div class="relative ">
              <button @click="isOpen = !isOpen" class="flex items-center space-x-2 focus:outline-none">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAA4VBMVEX////q6uHw0LRMRT/t7eXkxav8/Prq6uLx0rfOzsbd3dXt7ebr3Mvj49pCOjNJQjzy2MDt18H417o5MCj0vKNQSUNFPTc6NjPoya75+PU9NS7t7ezxzbLlyK/oz7njwqatqqjospuuq6N5dW9vaWLZ2NdbVVC8urg1KyKUkY6Rf3DOtJ04NTJtYliHdmjquaX36d23tbNjXVmNiYfS0M8rHxOin5yAe3jS0dB5al6fi3q4oo5mW1KvmofXvKQnKimdgXK1j3340sHmvqXy2M3zt5v1y7nCtKXHxLt0bme7uK/eVAhbAAAJkklEQVR4nO2dCX/aNhTAsRGYI9iEw+YIhCRArqbN0YWlWbut3dHk+3+gSZZvLFkyGZLy07/H1pI07897ejrsQKWi0Wg0Go1Go9FoNBqNRqPRaDQazf9BfXV3ublfD4fr+7OHx/PVWHRAb8t0sexPbNd1MK49mfTXD+cr0XG9EdPFum871SzQs9/f3Klveb68yNELgZbO5nwaf/hncZGWor5wJ2S92NI+W3xeTaerxfCXc9Exc/F4YRfphZau2+/Doeo4a9FBc3Bns/ohhkP83wtlmuz0fsLhFyv2p8X/thSc9wvHX76iKoaXfV6/UFERww1nhSYU+6JjZ6KkIFJUo5c+lhWEitWN6OgZ+HxRWhBOjAvR4Rcz5pkFt5j8Kjr+Yh7cXQz78k/4011qtOrci46/mN1SaD+Kjr+YnVIo/zBcXVa5F2spJJ/vV8sLdzdB50y0A5XFxW56EPtOtASNUovtDBcyL7sXbyAo9aJ0tVsPxUg9VyyzYxCfjPIZTiQ+WlylatRxPW/49PHjx5uqx9NdJ6I1KFwmVjKut/5ybfYwteenD6yrHOdFtAaFxETvXX3r9cyIRq929YEtj/ZCtAaZaVyk3nWvYabp1X7zmIpU4iXb52hX7171zC0avS8fGAxlPoS6i3e92QQGaXxmUHQ38iouQkPvOt/Q7F0zFKot7yHNY2Do3OTUaKhYnEWJ97+PbphCkqCvSGqp4cpAYsOgSikpRIrfqrkzo+Nd3WBFZylahEjQabxnwigMefK20uh4N9fmM/5890G0CJFzPFs4tBTiSl2nHB33w9P1aFQb4b+UeMpf+YbulyJD5Pjkef4tCy5cvN58rY1qkNGVX78Tea9xj/01jfetoEixo3n99Qquyq++osWrWfMN8Vwi85SP1qXOsDiFgSTG//8RVhyif6AqWoPCxiUs2AoJDFGZStxo8HThPZcQNIMyfYaGtsz3YcBW4/4+K29Y+/a7I/UwrFT63h8Dlj6zTVCmJ394jmgJKps/B4NSgoFh7dPgT5mHISzTweBHOcOgTH+cnEh8DgX5Phgc7Wr4XbQElb/fwPBEtASN8c6Gx9BQ5uu/uxvWTj69d8NPchvWdzWcHUPDumgNGoPdDGdzWKWfREtQ2W22mM1nsNP8JVqCChyIOxjOUQ6lHoaQ73+XNoR68JfkKYT886PcytucoQzWfsi9ovH5yyynOJ/BDB5Ln0HI+KiUIhSERTqTfBBi4EAsoTif+4aig2cC6fEqNho1v0oPRQfPxIHJq9jodruwz0DHW9HBM3Fr8ip2G+bIr9JjNQwrR5yKjS46xECt5lh06Ix0TU5FmEO8sZiLDp2R2yMORTgGG40uPodSpUgrlSh6FsEG+jnHhqIDZ+aAWRHaoSo1Z77ggejAmanHBgWGvqAZFqnUW980URKLFP0cNro1xVIIkxhvoYoVGwqmMJz12RS7pnoprMTtlEUxOGUTHTIn48RWv0AxqFEl9k1JDhIOdEUlaxSR1KIpqrVeS1JPapAVg0GoVB8NSQ5FoqKqgxDDoKi2IIOi6oJQkd5FfcFjNc7XiBxSjsBxAlXsoiluSYqqbXrJ1PPTiCv0UMlZYotxl5DAudojMEmu38gUHdbbkdgumqNQzzSP3k8K20exHySyfQddJuDWzEeNqxQsHBIMG6IDezMIgubR+5grKuP2QXZGDBZzh23le0193LYMwwD5iofoMas9VjaT4zYwAnIVfUH8sIq5HEfhExQTgj6WUpL1ttFqtgBV8TD1sNFptoy2KuXqpw8UKGYy2Gl2/A9SIZHj0IiqmC+IkLzvwPKMjSiKZEGIzMXaTsVNVqQKIkfRIgTGRgakmP4LrFgkCJFxPNatrTAN0Gl1trPIICjj5NHOidIAoNVKhw8VmQQN2Uq1nhsjsFChZhT/3Z4HSUjUcbZGYJhCAJBCwgmcXpwlFTuZZpRGmkrNrVDLMiwA4M9kRwWn/aqdUKQLSlOp+YJtlED/V6yIBKsJxVAwp0mFT4loOUR+EtqoSIMoQ0UsGCvGGZRaMTeDMDI8CpOKoWCoWFSikijmlygaggD10oQiaP4SvcRA/zLbgsgIHov5XRTgPhoLIMVOK87hC/wjo6Dgjpo/Dxp+YkFycEHFJizT4JVBlqDTZBYUOy/m1agFDJATvD+x4yROoFyHXVDkUMyrUQtFnqcI6eBXBpk02e18xNVp7hMOiIqgFRj+5DQ0RAnmpNACxATCB5plDUUlMU8Q9ReSYmhov/IaCkridgpRBlHzIRn+DAxPuQ3FJDFHAf1GWOSgh1/tsoZCkpgzCv0pkDgME4bcgkKSmJMrAMJemm8YzPj2I7+hiLVbJgS8Em23GQzdS35DAWWaLVJgEDtM9CHBK9aVMtx/mWaKFBR0Gf9jghdwdR9KGO6/TDObVnJt5hhuCMdrVPZumI7dSm8lCIYPuxjue4eRHIaWvxcsTiI4C14X8aWM4b4HYsIw3E0UKoKX8JUfWQyzNbFvw7inWNiMZRwueQyz7LvVJE95KTvCtOF9YHhfxnDf++DU187f1W/HOAwMh2UM991M06EzCRogfGVWRzlDthQaIHwxbJt8NUYaQ8IhW4FheJo4KWW43wmxlGEnMuQ9ilLFsDVRydBiG3pJQGzIfRSFZt09G6ZP7dkMm6UN/a+2/yrlVYwNeQ/b/BM8EeOQUzE8auM2DL6MGMPiLVMi0NfwjQU4D9t8Q2v/49AwOIdi0pBHEDe1tgqGp6Ghy3XYBvDXUsuQ6yhKlGH2Mi9DpI+lDYEAQ+zH1zDCt7/gPWzzv5K19/mwhGH0blDuht9w/zM+/6IGbKL94RnXJxpCDMus2s4iwxe+z8RDce85pNzIRDJ0IkPuTb4AQ35A9MZ6zm/yHwmXMlxHhmulDJmLNTxqK3vYpkAOqxEsh21WdlmvgGH89kBu8VHUdrOW39CwE4bFFznCja9Chp3ovQOrdvFRFLp5M51EwYYM/SZhyHDYhhIoV5UWK7bid7gsOIpCC21LwXEIltGqbUkdh/5NHcbWkya/odGJTjGa9KcCXTbffgoUMASvwR20p/Tp0L+crKRhsH9yz2izIb7FOO9IXQrDwnZTdeAP0vdy4WfBIh0ASWFYpAh+9quTV0oKaVeT5TAsVLzsb2iCtFuMJTEsVHyh1Cig3r4pi2GhIjmF4fcxyG5YGuo94u/BELr594gTa0B1QwtffqGguiEuT9pyVSpD3oNGg/7dRBIa8ioG31HblshQo9FoNBqNRqPRaDQajUaj0Wg0yvEf2UDbWIT+FEwAAAAASUVORK5CYII="
                class="w-10 h-10 rounded-full border-2 border-gray-300 object-cover">
              </button>
              <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 z-10 mt-2 w-48 bg-white rounded-md shadow-lg">
                <div class="" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                  <button id="toggleProfile"  class="w-full text-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-700 rounded-lg">
                    Profil
                  </button>
                  <div id="profile" class="min-h-screen bg-white shadow-lg rounded-lg p-6 fixed top-0 right-0 transform translate-x-full transition-transform duration-500">
                    <h2 class="text-lg font-bold text-gray-700">Profil</h2>
                    <hr class="my-2 border-gray-300">
                    <p class="text-gray-600 mt-2"><strong>Nama :</strong> {{ Auth::user()->name }}</p>
                    <p class="text-gray-600 mt-1"><strong>Email :</strong> {{ Auth::user()->email }}</p>
                    <button id="closeProfile" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 transition-all">Tutup</button>
                  </div>
                  <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-700 text-center">Dashboard</a>
                  <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                    @csrf
                    <button type="submit" class="w-full hover:text-blue-700 rounded-lg">Logout</button>
                  </form>
                </div>
              </div>
            </div>
            
            @else
              <a href="/login" class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2"/>
                </svg>
                Login
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
        
        <div class="-mr-2 flex md:hidden">
          <!-- Mobile menu button -->
          <button type="button"  @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
              <x-nav-link href="/posts" :active="request()->is('posts')">Blog</x-nav-link>
              <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
              <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
              <x-nav-link href="/login" :active="request()->is('login')" >Login</x-nav-link>
              
      </div>
    </div>
    <script>
      document.getElementById('toggleProfile').addEventListener('click', function () {
          document.getElementById('profile').classList.toggle('translate-x-0');
          document.getElementById('profile').classList.toggle('translate-x-full');
      });
      document.getElementById('closeProfile').addEventListener('click', function () {
          document.getElementById('profile').classList.add('translate-x-full');
      });
    </script>  
    
    
</nav>
