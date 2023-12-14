document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('menu-table');
    const pagination = document.getElementById('pagination');
    const itemsPerPage = 4;
    let currentPage = 1;
    let pageCount; // Variabel untuk menyimpan jumlah halaman

    // Function untuk menampilkan item pada halaman tertentu
    function displayItems(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        // Mengambil semua baris dari tbody
        const rows = table.querySelectorAll('tbody tr');

        // Menyembunyikan semua baris
        rows.forEach(row => {
            row.style.display = 'none';
        });

        // Menampilkan baris pada halaman tertentu
        for (let i = startIndex; i < endIndex && i < rows.length; i++) {
            rows[i].style.display = '';
        }
    }

    // Function untuk menambahkan tombol pagination
    function setupPagination() {
        const rows = table.querySelectorAll('tbody tr');
        pageCount = Math.ceil(rows.length / itemsPerPage);

        pagination.innerHTML = '';

        // Menambahkan tombol Prev dengan ikon dan kelas tambahan
        const prevButton = createPaginationButton('<i class="fas fa-angle-double-left"></i>', function () {
            if (currentPage > 1) {
                currentPage--;
                displayItems(currentPage);
                updatePaginationButtons();
            }
        });
        prevButton.classList.add('prev'); // Tambahkan kelas .prev
        pagination.appendChild(prevButton);

        // Menambahkan tombol untuk halaman saat ini
        const currentPageButton = createPaginationButton(currentPage, function () {
            // Tombol untuk halaman saat ini tidak dapat diklik
        });
        pagination.appendChild(currentPageButton);

        // Menambahkan tombol Next dengan ikon dan kelas tambahan
        const nextButton = createPaginationButton('<i class="fas fa-angle-double-right"></i>', function () {
            if (currentPage < pageCount) {
                currentPage++;
                displayItems(currentPage);
                updatePaginationButtons();
            }
        });
        nextButton.classList.add('next'); // Tambahkan kelas .next
        pagination.appendChild(nextButton);

        // Menampilkan item pada halaman pertama
        displayItems(currentPage);
        // Memperbarui tampilan tombol pagination
        updatePaginationButtons();
    }

    // Function untuk membuat tombol pagination
    function createPaginationButton(content, clickHandler) {
        const button = document.createElement('button');
        button.innerHTML = content;
        button.addEventListener('click', clickHandler);
        return button;
    }

    // Function untuk memperbarui tampilan tombol pagination
    function updatePaginationButtons() {
        const buttons = pagination.getElementsByTagName('button');

        buttons[1].innerText = currentPage; // Memperbarui teks tombol halaman saat ini

        for (let i = 0; i < buttons.length; i++) {
            buttons[i].classList.remove('active');
        }

        buttons[1].classList.add('active');

        // Menentukan apakah tombol "prev" atau "next" harus diubah warnanya menjadi lebih pudar
        if (currentPage === 1) {
            buttons[0].classList.add('disabled');
        } else {
            buttons[0].classList.remove('disabled');
        }

        if (currentPage === pageCount) {
            buttons[2].classList.add('disabled');
        } else {
            buttons[2].classList.remove('disabled');
        }
    }

    // Mengatur pagination saat halaman dimuat
    setupPagination();
});
