<footer>
    <div class="footer-content">
        {{-- Menggunakan Blade untuk menampilkan tahun saat ini (lebih profesional) --}}
        <p>&copy; {{ date('Y') }} Nails. All rights reserved.</p>
    </div>
</footer>

{{-- 
CATATAN: 
1. Kode <script> (seperti Chart.js dan JS kustom) TIDAK ditempatkan di sini. 
2. Kode <script> harus ditempatkan di app-admin.blade.php, tepat sebelum </body>. 
3. Jika diletakkan di sini, script akan dimuat sebelum tag </body>, yang sudah ditangani oleh Layout utama.
--}}