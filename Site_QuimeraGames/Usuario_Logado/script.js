<script>
    const userMenu = document.getElementById("userMenu");
    const dropdown = document.getElementById("dropdownMenu");

    // Abrir/fechar ao clicar
    userMenu.addEventListener("click", function (e) {
        e.stopPropagation(); // evita fechar imediatamente
    dropdown.classList.toggle("active");
});

    // Fechar ao clicar fora
    document.addEventListener("click", function () {
        dropdown.classList.remove("active");
});
</script>