    </main>
</div>
<!-- End Main Wrapper -->

<script>
    // Global Modal Functions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if(!modal) return;
        // Ambil elemen panel (bukan elemen backdrop pertama)
        const panel = modal.querySelector('.bg-white.rounded-2xl');
        modal.classList.remove('hidden');
        setTimeout(() => {
            panel.classList.remove('scale-95', 'opacity-0', 'translate-y-4');
            panel.classList.add('scale-100', 'opacity-100', 'translate-y-0');
        }, 10);
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if(!modal) return;
        const panel = modal.querySelector('.bg-white.rounded-2xl');
        panel.classList.remove('scale-100', 'opacity-100', 'translate-y-0');
        panel.classList.add('scale-95', 'opacity-0', 'translate-y-4');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
</body>
</html>
