<!-- FAQ Section (Modern Soft Style) -->
<section id="faq" class="py-16 lg:py-24 bg-white relative border-b border-slate-200" x-data="{ activeFaq: null }">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="max-w-2xl mx-auto mb-12 text-center">
      <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-950 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
        <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
        <span>Tanya Jawab</span>
      </div>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Pertanyaan Umum (FAQ)
      </h2>
      <p class="mt-3 text-sm sm:text-base text-slate-600">
        Informasi yang sering ditanyakan oleh calon siswa/i dan orang tua / wali murid seputar Madrasah Aliyah Darun Najah.
      </p>
    </div>

    <!-- Accordion List (Soft Rounded) -->
    <div class="space-y-3.5">
      
      <!-- FAQ 1 -->
      <div class="border border-slate-200 rounded-xl overflow-hidden transition-colors" :class="activeFaq === 1 ? 'border-emerald-700 bg-emerald-50/20' : 'bg-slate-50/60'">
        <button @click="activeFaq = (activeFaq === 1 ? null : 1)" 
                class="w-full flex items-center justify-between p-5 text-left font-bold text-sm sm:text-base text-slate-900 focus:outline-none cursor-pointer">
          <span>Apakah siswa/i diperbolehkan tidak berasrama (reguler / pulang-pergi)?</span>
          <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-300" :class="activeFaq === 1 ? 'rotate-180 text-emerald-700' : ''"></i>
        </button>
        <div x-show="activeFaq === 1" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-cloak 
             class="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-200 pt-3">
          Ya, Madrasah Aliyah Darun Najah menerima siswa/i asrama (bermukim) maupun siswa/i reguler (pulang pergi bagi yang berdomisili dekat). Untuk pendalaman keagamaan dan tahfidz intensif, siswa/i dapat memanfaatkan fasilitas asrama madrasah.
        </div>
      </div>

      <!-- FAQ 2 -->
      <div class="border border-slate-200 rounded-xl overflow-hidden transition-colors" :class="activeFaq === 2 ? 'border-emerald-700 bg-emerald-50/20' : 'bg-slate-50/60'">
        <button @click="activeFaq = (activeFaq === 2 ? null : 2)" 
                class="w-full flex items-center justify-between p-5 text-left font-bold text-sm sm:text-base text-slate-900 focus:outline-none cursor-pointer">
          <span>Bagaimana legalitas ijazah kelulusan Madrasah Aliyah Darun Najah?</span>
          <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-300" :class="activeFaq === 2 ? 'rotate-180 text-emerald-700' : ''"></i>
        </button>
        <div x-show="activeFaq === 2" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-cloak 
             class="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-200 pt-3">
          Ijazah Madrasah Aliyah Darun Najah adalah ijazah resmi negara di bawah Kementerian Agama RI yang setara dengan SMA/SMK dan terakreditasi. Lulusan dapat melanjutkan kuliah ke Perguruan Tinggi Negeri (PTN), PTKIN (UIN/IAIN), Perguruan Tinggi Kedinasan, maupun kampus swasta dan luar negeri.
        </div>
      </div>

      <!-- FAQ 3 -->
      <div class="border border-slate-200 rounded-xl overflow-hidden transition-colors" :class="activeFaq === 3 ? 'border-emerald-700 bg-emerald-50/20' : 'bg-slate-50/60'">
        <button @click="activeFaq = (activeFaq === 3 ? null : 3)" 
                class="w-full flex items-center justify-between p-5 text-left font-bold text-sm sm:text-base text-slate-900 focus:outline-none cursor-pointer">
          <span>Apakah tersedia beasiswa bagi siswa/i berprestasi atau yatim/piatu?</span>
          <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-300" :class="activeFaq === 3 ? 'rotate-180 text-emerald-700' : ''"></i>
        </button>
        <div x-show="activeFaq === 3" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-cloak 
             class="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-200 pt-3">
          Tersedia program beasiswa tahfidz Al-Qur'an (minimal 3 juz mutqin), beasiswa prestasi akademik/olahraga, serta keringanan biaya pendidikan khusus siswa/i yatim/piatu dan dhuafa melalui program kemitraan madrasah.
        </div>
      </div>

      <!-- FAQ 4 -->
      <div class="border border-slate-200 rounded-xl overflow-hidden transition-colors" :class="activeFaq === 4 ? 'border-emerald-700 bg-emerald-50/20' : 'bg-slate-50/60'">
        <button @click="activeFaq = (activeFaq === 4 ? null : 4)" 
                class="w-full flex items-center justify-between p-5 text-left font-bold text-sm sm:text-base text-slate-900 focus:outline-none cursor-pointer">
          <span>Bagaimana kegiatan harian siswa/i yang tinggal di asrama?</span>
          <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-300" :class="activeFaq === 4 ? 'rotate-180 text-emerald-700' : ''"></i>
        </button>
        <div x-show="activeFaq === 4" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-cloak 
             class="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-200 pt-3">
          Kegiatan siswa/i asrama dimulai dari sholat tahajud & subuh berjamaah, pengajian keislaman pagi, pembelajaran formal madrasah (07.00 - 13.30), sholat ashar dan istighosah, bimbingan hafalan Al-Qur'an ba'da maghrib, hingga belajar mandiri dan halaqoh ba'da isya.
        </div>
      </div>

    </div>

  </div>
</section>
