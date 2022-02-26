-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Feb 2022 pada 17.24
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eclassroom_v2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_album`
--

CREATE TABLE `t_album` (
  `album_id` int(11) NOT NULL,
  `album_name` text DEFAULT NULL,
  `album_kelas` text DEFAULT NULL,
  `album_pelajaran` text DEFAULT NULL,
  `album_tanggal` date DEFAULT NULL,
  `album_jenis` set('galery','video') DEFAULT NULL,
  `album_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_album`
--

INSERT INTO `t_album` (`album_id`, `album_name`, `album_kelas`, `album_pelajaran`, `album_tanggal`, `album_jenis`, `album_hapus`) VALUES
(3, 'Youtube Video', '2,3', '1', '2021-12-05', 'video', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_assigment`
--

CREATE TABLE `t_assigment` (
  `assigment_id` int(11) NOT NULL,
  `assigment_guru` text NOT NULL,
  `assigment_jenis` enum('individu','kelompok') NOT NULL,
  `assigment_judul` text NOT NULL,
  `assigment_isi` text NOT NULL,
  `assigment_pelajaran` text NOT NULL,
  `assigment_kelas` text NOT NULL,
  `assigment_tanggal` date NOT NULL DEFAULT curdate(),
  `assigment_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_assigment`
--

INSERT INTO `t_assigment` (`assigment_id`, `assigment_guru`, `assigment_jenis`, `assigment_judul`, `assigment_isi`, `assigment_pelajaran`, `assigment_kelas`, `assigment_tanggal`, `assigment_hapus`) VALUES
(2, '5', 'kelompok', 'carilah makalah tentang binary option judi berkedok trading binomo, aoutex', '<p>Catatan :</p>\r\n\r\n<p>1. Harus ada foto indrakenz</p>\r\n\r\n<p>2. harus ada foto doni salmanan</p>\r\n\r\n<p>3. harus ada &quot;murah banget&quot;</p>\r\n\r\n<p>4. harus ada foto jam rolex<br />\r\n&nbsp;</p>\r\n', '1', '1,2', '2022-02-21', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_assigment_hasil`
--

CREATE TABLE `t_assigment_hasil` (
  `assigment_hasil_id` int(11) NOT NULL,
  `assigment_hasil_soal` text NOT NULL,
  `assigment_hasil_siswa` text NOT NULL,
  `assigment_hasil_kelompok` text NOT NULL,
  `assigment_hasil_jenis` enum('individu','kelompok') NOT NULL,
  `assigment_hasil_file` text NOT NULL,
  `assigment_hasil_file_type` text NOT NULL,
  `assigment_hasil_catatan` text NOT NULL,
  `assigment_hasil_nilai` text NOT NULL,
  `assigment_hasil_nilai_catatan` text NOT NULL,
  `assigment_hasil_hapus` int(11) NOT NULL DEFAULT 0,
  `assigment_hasil_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_assigment_hasil`
--

INSERT INTO `t_assigment_hasil` (`assigment_hasil_id`, `assigment_hasil_soal`, `assigment_hasil_siswa`, `assigment_hasil_kelompok`, `assigment_hasil_jenis`, `assigment_hasil_file`, `assigment_hasil_file_type`, `assigment_hasil_catatan`, `assigment_hasil_nilai`, `assigment_hasil_nilai_catatan`, `assigment_hasil_hapus`, `assigment_hasil_tanggal`) VALUES
(10, '2', '12', '1', 'kelompok', 'cf2f125087a097c601303c6f687d2646.pdf', 'application', 'Makalah majelis ulama indonesia tentang binary option', '80', 'Sudah bagus dan mantap jivva nusantara', 0, '2022-02-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_chat`
--

CREATE TABLE `t_chat` (
  `chat_id` int(11) NOT NULL,
  `chat_name` text DEFAULT NULL,
  `chat_user` text DEFAULT NULL,
  `chat_target` text DEFAULT NULL,
  `chat_text` text DEFAULT NULL,
  `chat_type` set('personal','group') DEFAULT NULL,
  `chat_view` text DEFAULT NULL,
  `chat_tanggal` date DEFAULT curdate(),
  `chat_waktu` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_chat`
--

INSERT INTO `t_chat` (`chat_id`, `chat_name`, `chat_user`, `chat_target`, `chat_text`, `chat_type`, `chat_view`, `chat_tanggal`, `chat_waktu`) VALUES
(195, '23', '12', '11,12', 'test', 'personal', '11,12', '2021-12-19', '13:15:15'),
(196, '23', '11', '11,12', 'test', 'personal', '11,12', '2021-12-19', '13:15:15'),
(198, '23', '11', '11,12', 'hallo uzumaki ?', 'personal', '11,12', '2021-12-19', '13:49:33'),
(199, '22', '11', '11,12', 'new', 'personal', '11,12', '2021-12-19', '13:49:33'),
(200, '22', '11', '11,12', 'new123', 'personal', '11,12', '2021-12-19', '13:49:33'),
(201, '16', '5', '5,11', 'hallo uciha ?', 'personal', '11,5', '2021-12-20', '09:20:57'),
(202, '16', '5', '5,11', 'Apa kabar uciha ?', 'personal', '11,5', '2021-12-20', '09:21:29'),
(203, '17', '5', '5,12', 'halo uzumaki ?', 'personal', '12,5', '2021-12-20', '09:28:35'),
(205, 'Group Receh', '5', '8,9,11,12', 'ini group baru gess', 'group', '12,5,8', '2021-12-20', '09:36:17'),
(207, 'Group Receh', '5', '8,9,11,12', 'test bro', 'group', '12,5,8', '2021-12-20', '10:58:59'),
(209, 'Group Receh', '12', '8,9,11,12', 'ok pak', 'group', '12,5,8', '2021-12-20', '11:13:52'),
(214, NULL, '11', NULL, 'test', '', '11', '2022-02-17', '11:25:58'),
(215, NULL, '11', NULL, 'test', '', '11', '2022-02-17', '11:27:21'),
(216, NULL, '11', NULL, 'test', '', '11', '2022-02-17', '11:28:39'),
(217, 'Group Receh', '8', '8,9,11,12', 'siap', 'group', '8', '2022-02-25', '23:58:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_diskusi`
--

CREATE TABLE `t_diskusi` (
  `diskusi_id` int(11) NOT NULL,
  `diskusi_type` set('kelas','materi','kelompok') NOT NULL,
  `diskusi_siswa` text NOT NULL,
  `diskusi_text` text NOT NULL,
  `diskusi_file` text NOT NULL,
  `diskusi_file_type` text NOT NULL,
  `diskusi_view` text NOT NULL,
  `diskusi_where` text NOT NULL,
  `diskusi_tanggal` date NOT NULL DEFAULT curdate(),
  `diskusi_waktu` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_diskusi`
--

INSERT INTO `t_diskusi` (`diskusi_id`, `diskusi_type`, `diskusi_siswa`, `diskusi_text`, `diskusi_file`, `diskusi_file_type`, `diskusi_view`, `diskusi_where`, `diskusi_tanggal`, `diskusi_waktu`) VALUES
(7, 'kelas', '11', 'ok sip', '', '', '11,12', '1', '2022-02-15', '12:03:05'),
(32, 'kelas', '12', 'ini file png', '19c9fd78b2f77e04e5045d75b47b46ae.png', 'image', '12', '1', '2022-02-18', '01:12:55'),
(39, 'kelas', '12', 'ini file txt', '99920c409f91bc0bf293297b2ae4661c.txt', 'text', '12', '1', '2022-02-18', '01:56:42'),
(44, 'materi', '12', 'ini materi spongebob squarepants', '', '', '12', '3', '2022-02-18', '21:39:56'),
(47, 'materi', '12', 'iki donat masseh', '311565e9f1def5da46daa62a06d86bce.png', 'image', '12', '4', '2022-02-18', '21:42:35'),
(49, 'materi', '11', 'testing masseh', '', '', '11,12', '4', '2022-02-18', '21:42:35'),
(51, 'kelompok', '12', 'test gambar kelompok mawar404 masseh', '2579d0949f2473aebe68e3b902361629.png', 'image', '12', '1', '2022-02-19', '07:47:13'),
(52, 'kelompok', '11', 'test live chat masseh', '', '', '11,12', '1', '2022-02-19', '07:47:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_essay`
--

CREATE TABLE `t_essay` (
  `essay_id` text NOT NULL,
  `essay_guru` text NOT NULL,
  `essay_kelas` text NOT NULL,
  `essay_pelajaran` text NOT NULL,
  `essay_judul` text NOT NULL,
  `essay_jumlah` text NOT NULL,
  `essay_text` text NOT NULL,
  `essay_tanggal` date NOT NULL DEFAULT curdate(),
  `essay_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_essay`
--

INSERT INTO `t_essay` (`essay_id`, `essay_guru`, `essay_kelas`, `essay_pelajaran`, `essay_judul`, `essay_jumlah`, `essay_text`, `essay_tanggal`, `essay_hapus`) VALUES
('SOAL1', '8', '1,2,3', '1', 'Manfaat sosiologi', '5', '{\"essay_jumlah\":\"5\",\"essay_id\":\"SOAL1\",\"essay_judul\":\"Manfaat sosiologi\",\"essay_pelajaran\":\"1\",\"essay_kelas\":[\"1\",\"2\",\"3\"],\"soal1\":\"Jelaskan yang dimaksud dengan gejala sosial!\",\"gambar1\":\"SOAL1_1\",\"soal2\":\"Gejala sosial timbul dari adanya kemiskinan. Sebutkan ciri-ciri kemiskinan!\",\"gambar2\":\"SOAL1_2\",\"soal3\":\"Sebutkan faktor-faktor yang menyebabkan terjadinya perilaku menyimpang!\",\"gambar3\":\"SOAL1_3\",\"soal4\":\"Jelaskan perbedaan antara penyimpangan primer dengan penyimpangan sekunder!\",\"gambar4\":\"SOAL1_4\",\"soal5\":\"Jelaskan bagaimana suatu gejala dapat dikatakan sebagai gejala sosial!\",\"gambar5\":\"SOAL1_5\"}', '2022-02-26', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_essay_hasil`
--

CREATE TABLE `t_essay_hasil` (
  `essay_hasil_id` int(11) NOT NULL,
  `essay_hasil_siswa` text NOT NULL,
  `essay_hasil_soal` text NOT NULL,
  `essay_hasil_jawaban` text NOT NULL,
  `essay_hasil_nilai` text NOT NULL,
  `essay_hasil_nilai_total` text NOT NULL,
  `essay_hasil_pengkoreksi` text NOT NULL,
  `essay_hasil_hapus` int(11) NOT NULL DEFAULT 0,
  `essay_hasil_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_essay_hasil`
--

INSERT INTO `t_essay_hasil` (`essay_hasil_id`, `essay_hasil_siswa`, `essay_hasil_soal`, `essay_hasil_jawaban`, `essay_hasil_nilai`, `essay_hasil_nilai_total`, `essay_hasil_pengkoreksi`, `essay_hasil_hapus`, `essay_hasil_tanggal`) VALUES
(4, '12', 'SOAL1', '{\"essay_id\":\"SOAL1\",\"jawab1\":\"Gejala sosial adalah peristiwa-peristiwa yang terjadi dalam masyarakat atau dalam kehidupan sosial.\",\"jawab2\":\"Ciri-ciri kemiskinan, antara lain:\\r\\n- Mereka tidak memiliki faktor poduksi, seperti tanah, modal, ataupun keterampilan, sehingga kemampuan untuk memperoleh pendapatan menjadi terbatas.\\r\\n- Mereka tidak memiliki kemungkinan untuk memperoleh aset produksi dengan kekuatan sendiri.\\r\\n- Tingkat pendidikan rendah dan waktu mereka tersita untuk mencari nafkah.\\r\\n- Kebanyakan mereka tinggal di pedesaan.\\r\\n- Mereka yang hidup dikota masih berusia muda dan tidak didukung oleh keterampilan yang memadai.\",\"jawab3\":\"Faktor-faktor yang menyebabkan perilaku menyimpang, antara lain:\\r\\n- Adanya perubahan norma-norma dari suatu periode ke periode waktu lain.\\r\\n- Tidak ada norma atau aturan yang bersifat mutlak yang bisa digunakan untuk menentukan benar atau tidaknya kelakuan seseorang.\\r\\n- Adanya individu-individu yang tidak mematuhi norma.\\r\\n- Adanya individu-individu yang belum mendalami norma atau belum menyadari kenpa norma-norma itu harus dipatuhi.\\r\\n- Terdapatnya individu-individu yang kurang yakin akan kebenarannya atau kebailkan norma dimana terdapat norma-norma yang tidak sesuai\",\"jawab4\":\"Perbedaan penyimpangan primer dengan sekunder yaitu:\\r\\n- Penyimpangan primer adalah penyimpangan bersifat sementara (temporer) atau perbuatan menyimpang yang pertama kali dilakukan seseorang yang pada aspek kehidupan lain, selalu berlaku konfromis (mematuhi norma-norma yang berlaku).\\r\\n- Penyimpangan sekunder adalah penyimpangan sosial dilakukan secara terus-menerus, meskipun sanksi telah diberikan kepadanya.\",\"jawab5\":\"Suatu gejala dapat diakatakan sebagai gejala sosial apabila bersangkutan dengan hubungan antar manusia dan mengganggu keutuhan bermasyarakat.\"}', '{\"jumlah\":\"5\",\"nilai1\":\"5\",\"nilai2\":\"5\",\"nilai3\":\"5\",\"nilai4\":\"5\",\"nilai5\":\"5\"}', '25', '8', 0, '2022-02-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_hasil`
--

CREATE TABLE `t_hasil` (
  `hasil_id` int(11) NOT NULL,
  `hasil_siswa` text DEFAULT NULL,
  `hasil_soal` text DEFAULT NULL,
  `hasil_jawaban` text DEFAULT NULL,
  `hasil_nilai` text DEFAULT NULL,
  `hasil_sisa` text DEFAULT NULL,
  `hasil_tanggal` date DEFAULT curdate(),
  `hasil_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kelas`
--

CREATE TABLE `t_kelas` (
  `kelas_id` int(11) NOT NULL,
  `kelas_nama` text NOT NULL,
  `kelas_kepanjangan` text NOT NULL,
  `kelas_hapus` int(11) NOT NULL,
  `kelas_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_kelas`
--

INSERT INTO `t_kelas` (`kelas_id`, `kelas_nama`, `kelas_kepanjangan`, `kelas_hapus`, `kelas_tanggal`) VALUES
(1, 'TKJ 1', 'Teknik Kerja Jaringan 1', 0, '2021-04-05'),
(2, 'ATPH', 'Agribisnis Tanaman Pangan dan Holtikultura', 0, '2021-04-15'),
(3, 'TKJ 2', 'Teknik Kerja Jaringan 2', 0, '2021-04-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kelompok`
--

CREATE TABLE `t_kelompok` (
  `kelompok_id` int(11) NOT NULL,
  `kelompok_nama` text NOT NULL,
  `kelompok_kelas` text NOT NULL,
  `kelompok_siswa` text NOT NULL,
  `kelompok_hapus` int(11) NOT NULL DEFAULT 0,
  `kelompok_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_kelompok`
--

INSERT INTO `t_kelompok` (`kelompok_id`, `kelompok_nama`, `kelompok_kelas`, `kelompok_siswa`, `kelompok_hapus`, `kelompok_tanggal`) VALUES
(1, 'Mawar 404', '1', '11,12', 0, '2022-02-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_materi`
--

CREATE TABLE `t_materi` (
  `materi_id` int(11) NOT NULL,
  `materi_user` int(11) DEFAULT NULL,
  `materi_pelajaran` text DEFAULT NULL,
  `materi_kelas` text DEFAULT NULL,
  `materi_judul` text DEFAULT NULL,
  `materi_isi` text DEFAULT NULL,
  `materi_hapus` int(11) DEFAULT 0,
  `materi_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_materi`
--

INSERT INTO `t_materi` (`materi_id`, `materi_user`, `materi_pelajaran`, `materi_kelas`, `materi_judul`, `materi_isi`, `materi_hapus`, `materi_tanggal`) VALUES
(3, 1, '1', '1,2,3', 'Spongebob Squarepant', '<p>Serial film kartun SpongeBob SquarePants adalah serial kartun terlaris sepanjang masa. Bahkan para penggemarnya datang dari berbagai kalangan usia. Apa kamu juga? Nah, beberapa fakta unik dan menarik juga membuat film ini menjadi sangat menarik untuk diulas.</p>\r\n\r\n<p>Ternyata para tokoh pemeran dalam serial kartun ini punya sejarah tanggal lahir, keluarga, ayah dan ibu loh. Mau tau seperti apa biografi para tokoh dalam serial film kartun terlaris ini? Simak dalam artikel berikut ini.</p>\r\n\r\n<h2>1. Spongebob</h2>\r\n\r\n<p><img alt=\"Fakta dan Biodata Para Tokoh Dalam Serial Kartun SpongeBob SquarePants\" src=\"https://cdn.idntimes.com/content-images/community/2019/06/spongebob-bmtcdauaehc-d05c2ac33b57789a8a1885ebfcf96819.jpg\" />instagram.com/spongebob</p>\r\n\r\n<ul>\r\n	<li>Nama : SpongeBob SquarePants</li>\r\n	<li>TTL : Bikini Bottom,&nbsp;14 Juli&nbsp;1986</li>\r\n	<li>Ayah : Horald SquarePants</li>\r\n	<li>Ibu : Margareth SquarePants</li>\r\n	<li>Jenis Kelamin : Laki-laki</li>\r\n	<li>Pekerjaan : Koki di restoran Krusty Krab</li>\r\n	<li>Alamat tinggal : Jalan Conch No.124, kota Bikini Bottom, pulau Bikini Atoll.&nbsp;</li>\r\n	<li>Hobi : Berburu ubur-ubur dan meniup gelembung</li>\r\n	<li>Makanan kesukaan : Krabby patty, ice cream</li>\r\n</ul>\r\n\r\n<h2>2. Squidward</h2>\r\n\r\n<p><img alt=\"Fakta dan Biodata Para Tokoh Dalam Serial Kartun SpongeBob SquarePants\" src=\"https://cdn.idntimes.com/content-images/community/2019/06/spongebob-bvufcpthafn-ebe8f4d15a7400e43677a7a3fdc36165.jpg\" style=\"height:600px; width:600px\" /></p>\r\n\r\n<p>instagram.com/spongebob</p>\r\n\r\n<ul>\r\n	<li>Nama : Squidward Quincy Tentacles</li>\r\n	<li>TTL : 9 Oktober 1977</li>\r\n	<li>Ayah : Mr. Tentacles</li>\r\n	<li>Ibu : Mrs. Tentacles</li>\r\n	<li>Jenis Kelamin : Laki-laki</li>\r\n	<li>Pekerjaan : Penjaga kasir di restoran Krusty Krab</li>\r\n	<li>Alamat tinggal : Jalan Conch No. 122, kota Bikini Bottom, pulau&nbsp;</li>\r\n	<li>Hobi : Bermain klarinet, melukis dan semua hal yang berkaitan dengan dunia seni.</li>\r\n	<li>Makanan kesukaan : *Krabby patty (kadang-kadang)</li>\r\n</ul>\r\n\r\n<h2>3. Patrick Star</h2>\r\n\r\n<p><img alt=\"Fakta dan Biodata Para Tokoh Dalam Serial Kartun SpongeBob SquarePants\" src=\"https://cdn.idntimes.com/content-images/community/2019/06/patrickstar-official-bmo11sfld-d-3bc2dc3aeedfd1c9d89ebeddb47a62a1.jpg\" style=\"height:478px; width:497px\" /></p>\r\n\r\n<p>instagram.com/patrickstar_official</p>\r\n\r\n<ul>\r\n	<li>Nama : Patrick Dempsey Star</li>\r\n	<li>TTL : 26 Februari 1986</li>\r\n	<li>Ayah : Herb</li>\r\n	<li>Ibu : Margie</li>\r\n	<li>Jenis Kelamin : Laki-laki</li>\r\n	<li>Pekerjaan : -</li>\r\n	<li>Alamat tinggal : Jalan Conch No. 120, kota Bikini Bottom, pulau Bikini Atoll</li>\r\n	<li>Hobi : berburu ubur-ubur dan meniup gelembung</li>\r\n	<li>Makanan kesukaan : Kraby patty, ice cream, sandwich dengan selai ubur-ubur dan masih banyak lagi.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>4. Mr Krabs</h2>\r\n\r\n<p><img alt=\"Fakta dan Biodata Para Tokoh Dalam Serial Kartun SpongeBob SquarePants\" src=\"https://cdn.idntimes.com/content-images/community/2019/06/spongebob-bfylo2dgtl9-5316b70f3abdc35ed6d7622245f03556.jpg\" /></p>\r\n\r\n<ul>\r\n	<li>Nama : Eugene Horald Krabs</li>\r\n	<li>TTL : 30 November 1942</li>\r\n	<li>Ayah : Victor Krabs</li>\r\n	<li>Ibu : Betsy Krabs</li>\r\n	<li>Istri : Karient Whale (Meninggal)</li>\r\n	<li>Anak : Pearl</li>\r\n	<li>Jenis Kelamin : Laki-laki</li>\r\n	<li>Pekerjaan : Pengusaha (Pemilik dan pendiri Krusty Krab).</li>\r\n	<li>Alamat tinggal : 3541 Anchor&nbsp;Way,&nbsp;Bikini Bottom&nbsp;,Samudera Pasifik</li>\r\n	<li>Hobi : Mengumpulkan uang dan harta lainnnya</li>\r\n</ul>\r\n', 0, '2021-04-05'),
(4, 11, '1', '1,2', 'Pengertian Anime', '<p><strong>Anime&nbsp;</strong>adalah kata yang digunakan oleh orang-orang yang tinggal di luar negara Jepang untuk menggambarkan kartun atau animasi yang diproduksi di Jepang. Menggunakan kata anime dalam percakapan bahasa Indonesia atau Inggris sekalipun pada dasarnya sama dengan menggambarkan sesuatu sebagai serial kartun Jepang atau film animasi atau pertunjukan dari Jepang berdasarkan simpulan Kami yang bersumber dari.</p>\r\n\r\n<p>Kata anime sendiri hanyalah kata Jepang untuk kartun atau animasi yang digunakan oleh orang-orang untuk menggambarkan semua kartun terlepas dari negara asalnya. Sebagai contoh, misalnya orang Jepang akan menganggap Naruto Shippuden dan Disney&rsquo;s Frozen sebagai Anime, bukan sebagai sebuah genre yang berbeda.</p>\r\n\r\n<h2>Apa itu Anime?</h2>\r\n\r\n<p>Lalu, apa sebenarnya itu anime? Ini (アニメ dalam bahasa Jepang) dibaca: a-ni-me, bukan a-nim,&nbsp;<strong>anime</strong>&nbsp;adalah animasi khas Jepang, yang biasanya, mereka dicirikan melalui gambar-gambar berwarna-warni yang menampilkan tokoh-tokoh didalam berbagai macam lokasi dan juga cerita, yang ditujukan kepada beragam jenis penonton. Biasanya Anime ini, dipengaruhi gaya gambar manga, yaitu komik khas Jepang.</p>\r\n\r\n<h2>Apa itu Manga?</h2>\r\n\r\n<p>Dalam membahas tentang anime, tentu tidak terlepas dari kata manga.&nbsp;<strong>Manga</strong>&nbsp;adalah buku komik Jepang, yang sering menjadi inspirasi untuk serial anime. Sementara di negara Amerika, manga hanya merujuk pada komik dari Jepang, &ldquo;manga&rdquo; hanyalah kata Jepang untuk buku komik.</p>\r\n\r\n<p>Jadi di Jepang, semua komik secara teknis adalah manga. Jika Anda adalah penggemar anime dan buku komiknya, atau hanya sekedar gemar anime saja, pertimbangkan untuk menambahkan seri manga ke daftar bacaan Anda. Ada berbagai macam manga yang memikat serta menarik untuk dipilih.</p>\r\n\r\n<h2>Genre Anime</h2>\r\n\r\n<p><img alt=\"Ilustrasi Gambar Genre Genre Anime Dalam Membahas Pengertiannya\" src=\"https://i0.wp.com/rifqimulyawan.com/wp-content/uploads/2019/02/rm-ilustrasi-gambar-genre-anime.jpg?resize=696%2C465&amp;ssl=1\" style=\"height:465px; width:696px\" /></p>\r\n\r\n<p>Ilustrasi Gambar Genre Genre Anime Dalam Membahas Pengertiannya</p>\r\n\r\n<p>Setelah mengenal dan mengetahui apa itu anime dan penjelasannya di atas, kita juga harus mengenal apa saja genre-genre Anime yang sering ada dalam film animasi anime.</p>\r\n', 0, '2021-11-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pelajaran`
--

CREATE TABLE `t_pelajaran` (
  `pelajaran_id` int(11) NOT NULL,
  `pelajaran_nama` text NOT NULL,
  `pelajaran_hapus` int(11) NOT NULL DEFAULT 0,
  `pelajaran_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pelajaran`
--

INSERT INTO `t_pelajaran` (`pelajaran_id`, `pelajaran_nama`, `pelajaran_hapus`, `pelajaran_tanggal`) VALUES
(1, 'Pemrograman dasar', 0, '2021-04-05'),
(2, 'Web Design', 0, '2021-11-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pilihan`
--

CREATE TABLE `t_pilihan` (
  `pilihan_id` text NOT NULL DEFAULT '',
  `pilihan_acak` set('ya','tidak') NOT NULL DEFAULT '',
  `pilihan_guru` text NOT NULL,
  `pilihan_judul` text NOT NULL,
  `pilihan_jumlah` text NOT NULL,
  `pilihan_pertanyaan` text NOT NULL,
  `pilihan_kelas` text NOT NULL,
  `pilihan_pelajaran` text NOT NULL,
  `pilihan_hapus` int(11) NOT NULL DEFAULT 0,
  `pilihan_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pilihan`
--

INSERT INTO `t_pilihan` (`pilihan_id`, `pilihan_acak`, `pilihan_guru`, `pilihan_judul`, `pilihan_jumlah`, `pilihan_pertanyaan`, `pilihan_kelas`, `pilihan_pelajaran`, `pilihan_hapus`, `pilihan_tanggal`) VALUES
('SOAL1', 'ya', '8', 'Tebak Gambar Makanan', '3', '{\"pilihan_judul\":\"Tebak Gambar Makanan\",\"pilihan_pelajaran\":\"1\",\"pilihan_kelas\":[\"1\",\"2\",\"3\"],\"pilihan_acak\":\"ya\",\"pilihan_id\":\"SOAL1\",\"pilihan_jumlah\":\"3\",\"soal_pertanyaan1\":\"Gambar apakah ini ?\",\"gambar1\":\"SOAL1_1\",\"a1\":\"Jagung Bakar\",\"b1\":\"Permen\",\"c1\":\"Yakult\",\"d1\":\"Donat\",\"soal_kunci_jawaban1\":\"D\",\"soal_pertanyaan2\":\"Gambar apakah ini ?\",\"gambar2\":\"SOAL1_2\",\"a2\":\"Puding\",\"b2\":\"Es krim\",\"c2\":\"Pie Pisang\",\"d2\":\"Kue Leker\",\"soal_kunci_jawaban2\":\"B\",\"soal_pertanyaan3\":\"Gambar apakah ini ?\",\"gambar3\":\"SOAL1_3\",\"a3\":\"Semangka\",\"b3\":\"Bumi\",\"c3\":\"Gulali\",\"d3\":\"Es Krim\",\"soal_kunci_jawaban3\":\"C\"}', '1,2,3', '1', 0, '2022-02-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pilihan_hasil`
--

CREATE TABLE `t_pilihan_hasil` (
  `pilihan_hasil_id` int(11) NOT NULL,
  `pilihan_hasil_siswa` text NOT NULL,
  `pilihan_hasil_soal` text NOT NULL,
  `pilihan_hasil_jawaban` text NOT NULL,
  `pilihan_hasil_nilai` text NOT NULL,
  `pilihan_hasil_hapus` int(11) NOT NULL DEFAULT 0,
  `pilihan_hasil_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pilihan_hasil`
--

INSERT INTO `t_pilihan_hasil` (`pilihan_hasil_id`, `pilihan_hasil_siswa`, `pilihan_hasil_soal`, `pilihan_hasil_jawaban`, `pilihan_hasil_nilai`, `pilihan_hasil_hapus`, `pilihan_hasil_tanggal`) VALUES
(3, '12', 'SOAL1', '[\"D\",\"B\",\"C\"]', '100', 0, '2022-02-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_ujian`
--

CREATE TABLE `t_ujian` (
  `ujian_id` text NOT NULL,
  `ujian_judul` text DEFAULT NULL,
  `ujian_jumlah` char(50) DEFAULT NULL,
  `ujian_pertanyaan` text DEFAULT NULL,
  `ujian_timer` int(11) DEFAULT NULL,
  `ujian_pelajaran` text DEFAULT NULL,
  `ujian_kelas` text DEFAULT NULL,
  `ujian_berakhir` date DEFAULT NULL,
  `ujian_tanggal` date DEFAULT NULL,
  `ujian_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_ujian`
--

INSERT INTO `t_ujian` (`ujian_id`, `ujian_judul`, `ujian_jumlah`, `ujian_pertanyaan`, `ujian_timer`, `ujian_pelajaran`, `ujian_kelas`, `ujian_berakhir`, `ujian_tanggal`, `ujian_hapus`) VALUES
('SOAL1', 'Menebak nama-nama gambar', '2', '{\"ujian_judul\":\"Menebak nama-nama gambar\",\"ujian_berakhir\":\"2021-12-15\",\"ujian_pelajaran\":\"1\",\"ujian_timer\":\"10\",\"ujian_kelas\":[\"1\",\"3\"],\"ujian_id\":\"SOAL1\",\"ujian_jumlah\":\"2\",\"soal_pertanyaan1\":\"Tebak nama gambar berikut ?\",\"gambar1\":\"SOAL1_1\",\"a1\":\"Donat\",\"b1\":\"Kue kukus\",\"c1\":\"Bolu\",\"d1\":\"Keripik pisang\",\"soal_kunci_jawaban1\":\"A\",\"soal_pertanyaan2\":\"Logo berikut di miliki oleh perusahaan ?\",\"gambar2\":\"SOAL1_2\",\"a2\":\"Logo honda\",\"b2\":\"Logo nasa\",\"c2\":\"Logo youtube\",\"d2\":\"Logo instagram\",\"soal_kunci_jawaban2\":\"C\"}', 10, '1', '1,3', '2021-12-15', '2021-11-30', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `user_email` text DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_ttl` date DEFAULT NULL,
  `user_nohp` text DEFAULT NULL,
  `user_alamat` text DEFAULT NULL,
  `user_biodata` text DEFAULT NULL,
  `user_foto` text DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  `user_pelajaran` text DEFAULT NULL,
  `user_kelas` text DEFAULT NULL,
  `user_tanggal` date DEFAULT curdate(),
  `user_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_email`, `user_password`, `user_name`, `user_ttl`, `user_nohp`, `user_alamat`, `user_biodata`, `user_foto`, `user_level`, `user_pelajaran`, `user_kelas`, `user_tanggal`, `user_hapus`) VALUES
(5, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin ( Eclassroom )', '2021-11-09', '085555111555', 'Alamat', 'Biodata', NULL, 1, NULL, NULL, '2021-11-28', 0),
(8, '1111', 'b59c67bf196a4758191e42f76670ceba', 'Madun', '0000-00-00', '', '', '', NULL, 2, '1', NULL, '2021-11-30', 0),
(9, '2222', '934b535800b1cba8f96a5d72f72f1611', 'Valentino Rossi', NULL, NULL, NULL, NULL, NULL, 2, '2', NULL, '2021-11-28', 0),
(11, '3333', '2be9bd7a3434f7038ca27d1918de58bd', 'Uciha Sasuke', NULL, NULL, NULL, NULL, 'Riandaka_4.png', 3, NULL, '1', '2021-11-28', 0),
(12, '4444', 'dbc4d84bfcfe2284ba11beffb853a8c4', 'Uzumaki Naruto', NULL, NULL, NULL, NULL, NULL, 3, NULL, '1', '2021-11-28', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_video`
--

CREATE TABLE `t_video` (
  `video_id` int(11) NOT NULL,
  `video_judul` text DEFAULT NULL,
  `video_album` text DEFAULT NULL,
  `video_foto` text DEFAULT NULL,
  `video_link` text DEFAULT NULL,
  `video_tanggal` date DEFAULT NULL,
  `video_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_video`
--

INSERT INTO `t_video` (`video_id`, `video_judul`, `video_album`, `video_foto`, `video_link`, `video_tanggal`, `video_hapus`) VALUES
(5, 'KINGDOM ANIMALIA - Kerajaan Hewan || Materi IPA kelas 7', '3', 'PositifOtaku_Ano_hana_1.jpg', 'XFJL4NLmxOs', '2019-12-28', 0),
(6, 'Jenis dan Ciri-ciri Hewan Vertebrata', '3', NULL, '-kWqUQJywgU', '2021-04-03', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_album`
--
ALTER TABLE `t_album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indeks untuk tabel `t_assigment`
--
ALTER TABLE `t_assigment`
  ADD PRIMARY KEY (`assigment_id`);

--
-- Indeks untuk tabel `t_assigment_hasil`
--
ALTER TABLE `t_assigment_hasil`
  ADD PRIMARY KEY (`assigment_hasil_id`);

--
-- Indeks untuk tabel `t_chat`
--
ALTER TABLE `t_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indeks untuk tabel `t_diskusi`
--
ALTER TABLE `t_diskusi`
  ADD PRIMARY KEY (`diskusi_id`);

--
-- Indeks untuk tabel `t_essay_hasil`
--
ALTER TABLE `t_essay_hasil`
  ADD PRIMARY KEY (`essay_hasil_id`);

--
-- Indeks untuk tabel `t_hasil`
--
ALTER TABLE `t_hasil`
  ADD PRIMARY KEY (`hasil_id`);

--
-- Indeks untuk tabel `t_kelas`
--
ALTER TABLE `t_kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indeks untuk tabel `t_kelompok`
--
ALTER TABLE `t_kelompok`
  ADD PRIMARY KEY (`kelompok_id`);

--
-- Indeks untuk tabel `t_materi`
--
ALTER TABLE `t_materi`
  ADD PRIMARY KEY (`materi_id`);

--
-- Indeks untuk tabel `t_pelajaran`
--
ALTER TABLE `t_pelajaran`
  ADD PRIMARY KEY (`pelajaran_id`);

--
-- Indeks untuk tabel `t_pilihan_hasil`
--
ALTER TABLE `t_pilihan_hasil`
  ADD PRIMARY KEY (`pilihan_hasil_id`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `t_video`
--
ALTER TABLE `t_video`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_album`
--
ALTER TABLE `t_album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_assigment`
--
ALTER TABLE `t_assigment`
  MODIFY `assigment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_assigment_hasil`
--
ALTER TABLE `t_assigment_hasil`
  MODIFY `assigment_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `t_chat`
--
ALTER TABLE `t_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT untuk tabel `t_diskusi`
--
ALTER TABLE `t_diskusi`
  MODIFY `diskusi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `t_essay_hasil`
--
ALTER TABLE `t_essay_hasil`
  MODIFY `essay_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `t_hasil`
--
ALTER TABLE `t_hasil`
  MODIFY `hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `t_kelompok`
--
ALTER TABLE `t_kelompok`
  MODIFY `kelompok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_materi`
--
ALTER TABLE `t_materi`
  MODIFY `materi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `t_pelajaran`
--
ALTER TABLE `t_pelajaran`
  MODIFY `pelajaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_pilihan_hasil`
--
ALTER TABLE `t_pilihan_hasil`
  MODIFY `pilihan_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `t_video`
--
ALTER TABLE `t_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
