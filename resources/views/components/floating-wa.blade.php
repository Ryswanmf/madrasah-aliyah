<!-- Floating Widgets (WhatsApp & Back To Top) -->
<div x-data="{ showTopBtn: false }" 
     @scroll.window="showTopBtn = (window.pageYOffset > 300)"
     class="fixed bottom-5 right-5 z-40 flex flex-col items-end gap-3">
  
  <!-- Back To Top Button -->
  <button x-show="showTopBtn" 
          x-transition:enter="transition ease-out duration-300"
          x-transition:enter-start="opacity-0 translate-y-3"
          x-transition:enter-end="opacity-100 translate-y-0"
          x-transition:leave="transition ease-in duration-200"
          x-transition:leave-start="opacity-100 translate-y-0"
          x-transition:leave-end="opacity-0 translate-y-3"
          @click="window.scrollTo({ top: 0, behavior: 'smooth' })" 
          aria-label="Kembali ke atas"
          x-cloak
          class="w-11 h-11 rounded-full bg-slate-900/80 hover:bg-slate-900 text-white shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-105 backdrop-blur-xs border border-slate-700">
    <i class="fa-solid fa-arrow-up text-sm"></i>
  </button>

  <!-- Floating WhatsApp Button -->
  <a href="{{ $contact ? $contact->getWaLink() : 'https://wa.me/6285658973426' }}" 
     target="_blank" rel="noopener noreferrer" 
     aria-label="Konsultasi PPDB WhatsApp"
     class="group inline-flex items-center gap-2.5 bg-emerald-600 hover:bg-emerald-700 text-white shadow-xl shadow-emerald-600/30 rounded-full p-3.5 sm:px-5 sm:py-3 transition-all duration-200 hover:scale-105">
    <i class="fa-brands fa-whatsapp text-2xl"></i>
    <span class="hidden sm:inline-block font-bold text-xs">Konsultasi PPDB</span>
  </a>

</div>
