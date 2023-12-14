// toggle class active
const navbarNav = document.querySelector(".navbar-nav");
//menu diklik
document.querySelector("#hamburger-menu").onclick = () => {
  navbarNav.classList.toggle("active");
};

const Profil = document.querySelector(".profil");
document.querySelector("#user").onclick = (e) => {
  Profil.classList.toggle("active");
  e.preventDefault();
};

const Shopping = document.querySelector(".shopping");
document.querySelector("#shopping-cart").onclick = (e) => {
  Shopping.classList.toggle("active");
  e.preventDefault();
};

// klik diluar sidebar untuk menghilangkan navbar
const hm = document.querySelector("#hamburger-menu");
const ur = document.querySelector("#user");
const sc = document.querySelector("#shopping-cart");

// const sc = document.querySelector('#shopping-cart-button');

document.addEventListener("click", function (e) {
  if (!hm.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }

  if (!ur.contains(e.target) && !Profil.contains(e.target)) {
    Profil.classList.remove("active");
  }

  if (!sc.contains(e.target) && !Shopping.contains(e.target)) {
    Shopping.classList.remove("active");
  }
});

// BISMILLAHIRAHMANIRAHIM
// const MenuCards = document.querySelectorAll(".menu-card");
// const PopupMenu = document.querySelector(".pop-up-menu");

// // Menetapkan event listener untuk setiap 'menu-card'
// MenuCards.forEach((card) => {
//   card.addEventListener("click", (e) => {
//     PopupMenu.style.display = "flex";
//     e.preventDefault();
//   });
// });

// // Menetapkan aksi saat tombol "Batal" diklik
// document.querySelector(".cans .close-btn").onclick = (e) => {
//   PopupMenu.style.display = "none";
//   e.preventDefault();
// };

// // Menutup pop-up saat area di luar pop-up diklik
// window.onclick = (e) => {
//   if (e.target === PopupMenu) {
//     PopupMenu.style.display = "none";
//   }
// };

// Fungsi untuk mengambil data dari database PHP
// Fungsi untuk mengambil data menu dari server berdasarkan id_menu
// function fetchMenuData(menuId) {
//   fetch(`fetch_menu_data.php?id=${menuId}`)
//       .then(response => {
//           if (!response.ok) {
//               throw new Error('Network response was not ok.');
//           }
//           return response.text();
//       })
//       .then(data => {
//           populatePopup(data);
//       })
//       .catch(error => {
//           console.error('Error fetching menu data:', error);
//       });
// }

// function populatePopup(responseData) {
//   const popup = document.querySelector('.pop-up-menu');

//   if (responseData && responseData.trim() !== '') {
//       const dataArray = responseData.split(','); // Ubah sesuai dengan format yang dikirimkan dari PHP
//       const menuImage = dataArray[0]; // Misalnya, array pertama adalah gambar
//       const menuJenis = dataArray[1]; // Misalnya, array kedua adalah nama_menu
//       const menuHarga = dataArray[2]; // Misalnya, array ketiga adalah harga
//       const menuStatus = dataArray[3]; // Misalnya, array keempat adalah status

//       // Isi konten popup dengan data yang diterima dari server
//       document.querySelector('.menu-image').src = 'img/' + menuImage;
//       document.querySelector('.menu-jenis').textContent = menuJenis;
//       document.querySelector('.menu-harga').textContent = 'Rp. ' + menuHarga;
//       document.querySelector('.menu-status').textContent = menuStatus ? 'Tersedia' : 'Tidak Tersedia';

//       // Tampilkan popup
//       popup.style.display = 'flex';
//   } else {
//       console.error("Data tidak valid atau terjadi kesalahan:", responseData);
//   }
// }

// // Menambahkan event listener untuk setiap menu card
// const menuCards = document.querySelectorAll('.menu-card');
// menuCards.forEach((card) => {
//   card.addEventListener('click', (e) => {
//       const menuId = card.getAttribute('data-menu-id');
//       fetchMenuData(menuId); // Panggil fungsi untuk mengambil data ketika menu-card di-klik
//       e.preventDefault();
//   });
// });

// // Menutup pop-up saat tombol "Batal" diklik
// document.querySelector('.batal .close-btn').onclick = (e) => {
//   document.querySelector('.pop-up-menu').style.display = 'none';
//   e.preventDefault();
// };

// // Menutup pop-up saat area di luar pop-up diklik
// window.onclick = (e) => {
//   const popup = document.querySelector('.pop-up-menu');
//   if (e.target === popup) {
//       popup.style.display = 'none';
//   }
// };

// Mendapatkan semua elemen menu-card
// Ambil semua elemen menu card


const menuCards = document.querySelectorAll('.menu-card');

// Fungsi untuk menampilkan pop-up dengan detail menu
let keranjangBelanja = [];

function displayPopup(menu) {
  const popup = document.querySelector('.pop-up-menu');
  const menuImage = popup.querySelector('.menu-image');
  const menuJenis = popup.querySelector('.menu-jenis');
  const menuHarga = popup.querySelector('.menu-harga');
  const menuStatus = popup.querySelector('.menu-status'); // Menambah elemen status
  const statusMenuContainer = popup.querySelector('.status-menu'); // Menambah elemen status-menu
  const konfirmasiButton = popup.querySelector('.konfirmasi button');

  // Set informasi menu ke dalam pop-up
  menuImage.src = menu.querySelector('.menu-card-img').src;
  menuJenis.textContent = menu.querySelector('.menu-card-minuman, .menu-card-makanan').textContent;
  menuHarga.textContent = menu.querySelector('.menu-card-harga').textContent;

  // Ambil status dari atribut data pada menu-card
  const status = menu.getAttribute('data-status');
  menuStatus.textContent = `Status: ${status}`; // Menampilkan status di pop-up

  // Periksa jika status tidak tersedia, lalu ubah warna background jika tidak tersedia
  if (status === 'Tidak Tersedia') {
    statusMenuContainer.style.backgroundColor = '#FC0404'; // Mengubah background color menjadi merah
    statusMenuContainer.style.color = '#FFFFFF'; // Mengubah warna teks menjadi putih
  } else {
    statusMenuContainer.style.backgroundColor = ''; // Kembalikan ke warna asal jika status tersedia
    statusMenuContainer.style.color = '';
  }

  // Tambahkan event listener untuk tombol "Konfirmasi" di pop-up
  konfirmasiButton.addEventListener('click', function() {
    const gambarMakanan = menuImage.src;
    const jenisMenu = menuJenis.textContent;
    const hargaMenu = menuHarga.textContent;
  
    const existingProductIndex = keranjangBelanja.findIndex(product => product.jenis === jenisMenu);

    if (existingProductIndex !== -1) {
      // Jika produk sudah ada di keranjang, perbarui jumlah produk
      const jumlahInput = document.querySelector('.jumlah-produk');
      const newQuantity = parseInt(jumlahInput.value, 10);
    
      if (!isNaN(newQuantity) && newQuantity > 0) {
        keranjangBelanja[existingProductIndex].jumlah = newQuantity;
      }
    } else {
      // Jika produk belum ada di keranjang, tambahkan produk baru dengan jumlah yang diinput
      keranjangBelanja.push({ jenis: jenisMenu, harga: hargaMenu, jumlah: 1, gambar: gambarMakanan });
    }
  
    tampilkanKeranjangBelanja();
    popup.style.display = 'none';
  });
  

  // Tampilkan pop-up
  popup.style.display = 'flex';
}

function tampilkanKeranjangBelanja() {
  const produkKeranjang = document.querySelector('.keranjang-belanja');
  produkKeranjang.innerHTML = '';

  keranjangBelanja.forEach(produk => {
    const produkBaru = document.createElement('div');
    produkBaru.classList.add('produk');
    
    // Pastikan nilai jumlah dan harga adalah angka yang valid
    const jumlah = parseInt(produk.jumlah);
    const harga = parseFloat(produk.harga.replace(/\D/g, '')); // Menghapus karakter non-numerik dari harga sebelum mengonversi ke float

    // Verifikasi apakah nilai jumlah dan harga valid (berupa angka)
    if (!isNaN(jumlah) && !isNaN(harga)) {
      // Hitung harga total untuk setiap produk
      const hargaTotal = jumlah * harga;
      produk.hargaTotal = hargaTotal; // Simpan nilai hargaTotal ke dalam objek produk

      const inputValue = produk.jumlah; // Simpan nilai produk.jumlah ke dalam variabel inputValue

      produkBaru.innerHTML = `
        <div class="img-produk">
          <img src="${produk.gambar}" alt="" class="checkout-gambar">
        </div>
        <div class="ket-produk">
          <div class="produk-info">
            <p class="Menu-jenis">${produk.jenis}</p>
            <p class="Menu-harga">Rp.   ${hargaTotal}</p> <!-- Tampilkan harga total -->
          </div>
          <div class="jumlah">
            <div class="box-jumlah">
              <input type="number" class="jumlah-produk" value="${inputValue}" min="1" style="width: 40px;">
            </div>
          </div>
        </div>
      `;
      produkKeranjang.appendChild(produkBaru);
    } else {
      console.error("Nilai jumlah atau harga tidak valid untuk produk:", produk.jenis);
    }
  });
}

function simpanKeDatabase() {
  $.ajax({
    type: 'POST',
    url: 'simpan_produk.php', // File PHP untuk menyimpan data
    data: { produk: JSON.stringify(keranjangBelanja) }, // Kirim data ke PHP dalam bentuk JSON
    success: function (response) {
      console.log(response); // Output dari PHP setelah menyimpan data
      // Lakukan tindakan lain setelah data disimpan, jika diperlukan
      // Contohnya, mungkin menampilkan pesan konfirmasi kepada pengguna
      alert('Pembelian berhasil disimpan ke database.');
    },
    error: function (error) {
      console.error('Terjadi kesalahan:', error); // Tangani kesalahan jika ada
      // Contohnya, menampilkan pesan kesalahan kepada pengguna
      alert('Terjadi kesalahan saat menyimpan pembelian.');
    }
  });
}

// Fungsi untuk menangani klik tombol "Konfirmasi"
$('.item-conf-btn').on('click', function(e) {
  e.preventDefault(); // Mencegah perilaku default dari anchor tag

  // Di sini, Anda harus memperbarui nilai jumlah pada objek keranjangBelanja
  // Contoh: Ambil nilai jumlah dari elemen input dengan kelas .jumlah-produk
  var jumlahProduk = $('.jumlah-produk').val();

  // Konversi nilai jumlah ke angka
  jumlahProduk = parseInt(jumlahProduk);

  // Periksa apakah nilai jumlah adalah angka
  if (isNaN(jumlahProduk)) {
    jumlahProduk = 1;
  }

  // Update nilai jumlah pada objek keranjangBelanja
  keranjangBelanja[0].jumlah = jumlahProduk; // Misalnya, jika Anda mengambil indeks ke-0

  // Panggil fungsi untuk menyimpan ke database
  simpanKeDatabase();
});





// Fungsi untuk mengosongkan keranjang belanja
function kosongkanKeranjangBelanja() {
  keranjangBelanja = []; // Mengosongkan array keranjangBelanja
  tampilkanKeranjangBelanja(); // Memperbarui tampilan keranjang belanja setelah dihapus
}

// Menambahkan event listener untuk tombol 'Cancel'
const cancelLink = document.querySelector('.cancel');
cancelLink.addEventListener('click', function(event) {
  event.preventDefault(); // Untuk mencegah link bawaan dari berpindah halaman

  kosongkanKeranjangBelanja(); // Memanggil fungsi untuk mengosongkan keranjang belanja
});





// Tambahkan event listener pada setiap menu card
menuCards.forEach((card) => {
    card.addEventListener('click', (e) => {
        displayPopup(card);
        e.preventDefault();
    });
});

// Menutup pop-up saat tombol "Batal" diklik
document.querySelector('.batal .close-btn').onclick = (e) => {
    document.querySelector('.pop-up-menu').style.display = 'none';
    e.preventDefault();
};

// Menutup pop-up saat area di luar pop-up diklik
window.onclick = (e) => {
    const popup = document.querySelector('.pop-up-menu');
    if (e.target === popup) {
        popup.style.display = 'none';
    }
};












// chekout

// const MakananIni = document.querySelector("#makanan-ini");
// const CheckOut = document.querySelector(".item-conf-btn");

// CheckOut.onclick = (e) => {
//   MakananIni.style.display = "flex";
//   e.preventDefault();
// };

// // klik tombol bata
// document.querySelector(".beli .beli-container .batal-btn").onclick = (e) => {
//   MakananIni.style.display = "none";
//   e.preventDefault();
// };

// const CloseBeli = document.querySelector("#makanan-ini");
// window.onclick = (e) => {
//   if (e.target === CloseBeli) {
//     CloseBeli.style.display = "none";
//   }
// };
