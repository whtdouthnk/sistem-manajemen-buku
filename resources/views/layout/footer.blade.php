</div>
</main>

</div>
</div>
@include('sweetalert::alert')

<script>
    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    const sidebar = document.querySelector('aside');

    toggleSidebarBtn?.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });
</script>
</body>

</html>
