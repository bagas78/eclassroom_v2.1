-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 16 Bulan Mei 2022 pada 11.52
-- Versi server: 10.5.12-MariaDB-cll-lve
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u239022564_collassion`
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
(3, 'Youtube Video', '1,2,3', '1', '2021-12-05', 'video', 0),
(7, 'KB 1-1. Konsep Dasar Sistem Informasi', '9', '4', '2022-04-17', 'video', 0),
(8, 'KB 3-1. Merancang Pemodelan Fungsional dengan Diagram Use Case', '9', '4', '2022-04-15', 'video', 1),
(9, 'KB 1-2. Metodologi Pengembangan Sistem Informasi', '9', '4', '2022-04-17', 'video', 0),
(10, 'KB 2-1. Analisis Sistem', '9', '4', '2022-04-17', 'video', 0),
(11, 'KB 2-2. Pemodelan Sistem dengan Flow of Document', '9', '4', '2022-04-17', 'video', 0),
(12, 'KB 3-1. Pemodelan Fungsional dengan Diagram Use Case', '9', '4', '2022-04-17', 'video', 0),
(13, 'KB 3-2. Pemodelan Proses Bisnis dengan Diagram Aktivitas', '9', '4', '2022-04-17', 'video', 0),
(14, 'KB 3-3. Pemodelan Perilaku dengan Diagram Urutan', '9', '4', '2022-04-17', 'video', 0),
(15, 'KB 3-4. Pemodelan Struktural dengan Diagram Kelas', '9', '4', '2022-04-17', 'video', 0),
(16, 'KB 4-1. Merancang Arsitektur Program dengan Diagram HIPO', '9', '4', '2022-04-17', 'video', 0),
(17, 'KB 4-2. Merancang Antar Muka Pengguna', '9', '4', '2022-04-17', 'video', 0);

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
  `assigment_tampil` date DEFAULT NULL,
  `assigment_unggah` date DEFAULT NULL,
  `assigment_jam` time DEFAULT NULL,
  `assigment_file` text DEFAULT NULL,
  `assigment_tanggal` date NOT NULL DEFAULT curdate(),
  `assigment_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_assigment`
--

INSERT INTO `t_assigment` (`assigment_id`, `assigment_guru`, `assigment_jenis`, `assigment_judul`, `assigment_isi`, `assigment_pelajaran`, `assigment_kelas`, `assigment_tampil`, `assigment_unggah`, `assigment_jam`, `assigment_file`, `assigment_tanggal`, `assigment_hapus`) VALUES
(2, '5', 'kelompok', 'carilah makalah tentang binary option judi berkedok trading binomo, aoutex', '<p>Catatan :</p>\r\n\r\n<p>1. Harus ada foto indrakenz</p>\r\n\r\n<p>2. harus ada foto doni salmanan</p>\r\n\r\n<p>3. harus ada &quot;murah banget&quot;</p>\r\n\r\n<p>4. harus ada foto jam rolex<br />\r\n&nbsp;</p>\r\n', '1', '1,2,3', '2022-03-19', '2022-03-18', '14:17:34', 'f26e42b4dbc1940dbec9666191cfc6ec.docx', '2022-02-21', 0);

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
(13, '2', '11', '1', 'kelompok', 'd0b26fe5eb4d0f373c4cae27e3818172.docx', 'application', 'ini contoh', '', '', 0, '2022-03-22');

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
  `chat_waktu` time DEFAULT NULL
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
(205, 'Group Receh', '5', '8,9,11,12', 'ini group baru gess', 'group', '12,5,8,11', '2021-12-20', '09:36:17'),
(207, 'Group Receh', '5', '8,9,11,12', 'test bro', 'group', '12,5,8,11', '2021-12-20', '10:58:59'),
(209, 'Group Receh', '12', '8,9,11,12', 'ok pak', 'group', '12,5,8,11', '2021-12-20', '11:13:52'),
(214, NULL, '11', NULL, 'test', '', '11', '2022-02-17', '11:25:58'),
(215, NULL, '11', NULL, 'test', '', '11', '2022-02-17', '11:27:21'),
(216, NULL, '11', NULL, 'test', '', '11', '2022-02-17', '11:28:39'),
(217, 'Group Receh', '8', '8,9,11,12', 'siap', 'group', '8,11', '2022-02-25', '23:58:48'),
(218, '', '8', '', 'heloo', 'group', '8,28', '2022-04-14', '12:03:58'),
(219, '57', '28', '28,29', 'hendri... kok gak ngerjain post tes 1-1? kenapa?', 'personal', '28,29', '2022-04-14', '12:05:55'),
(220, '57', '29', '29,28', 'maaf buk. karena kemarin lupa jadwal', 'personal', '29,28', '2022-04-14', '12:11:29'),
(221, '36', '8', '8,28', 'selamat malam buk juhartini. saat ini lagi di uji chat dengan sesama dosen', 'personal', '8,28', '2022-04-14', '18:02:00'),
(223, '59', '29', '29,30', 'Gimana cara pake edraw max untuk bikin Diagram UML? apa yang kita pilih di awal kok saya cari UML gak ada ya?', 'personal', '29', '2022-04-16', '21:26:12'),
(224, '36', '28', '28,8', 'malam Pak.. udah bisa chat antar dosen ya ', 'personal', '28', '2022-04-16', '22:31:16'),
(225, 'belajar APSI', '29', '29,30,31,32', 'Gimana cara pake edraw max untuk bikin Diagram UML? apa yang kita pilih di awal kok saya cari UML gak ada ya?', 'group', '29,,31,30,32', '2022-04-16', '22:41:50'),
(226, 'belajar APSI', '31', '29,30,31,32', 'pilih software dulu, nanti muncul UML. klik UML trus ada pilihan jenis-jenis diagram UML yang kamu butuhkan', 'group', '31,,30,29,32', '2022-04-16', '22:43:27'),
(227, 'belajar APSI', '30', '29,30,31,32', 'kalo menurut saya lebih gampang pake visio. saya udah coba', 'group', '30,,29,32', '2022-04-16', '22:44:49'),
(228, '61', '29', '29,32', 'udah nyoba bikin FoD?', 'personal', '29,32', '2022-04-16', '22:47:51'),
(229, '61', '32', '32,29', 'udah tapi belum selesai, masih ada yang bingung. pihak yang terlibat di sistem selain kaprodi, dosen pembimbing, mahasiswa dan dosen penguji, ada lagi gak? apakah staf administrasi juga digambarkan?', 'personal', '32,29', '2022-04-16', '22:50:38'),
(230, '72', '43', '43,29', 'P', 'personal', '43,29', '2022-04-25', '06:20:08'),
(231, 'ugal ugalan', '37', '37,38,39,41,42', 'halooo', 'group', '37,41,38,39,42', '2022-04-25', '06:20:39'),
(232, 'ugal ugalan', '38', '37,38,39,41,42', 'hai', 'group', '38,41,39,42,37', '2022-04-25', '06:21:00'),
(233, 'ugal ugalan', '41', '37,38,39,41,42', 'Arya Sentosa Group', 'group', '41,42,38,39', '2022-04-25', '06:21:02'),
(236, '88', '45', '45,43', 'P', 'personal', '45,43', '2022-04-25', '06:21:35'),
(237, 'OKE', '43', '43,45', 'OK', 'group', '43,45', '2022-04-25', '06:21:42'),
(238, 'ugal ugalan', '42', '37,38,39,41,42', 'p', 'group', '42,41,38,39', '2022-04-25', '06:21:56'),
(239, '88', '43', '43,45', 'WET', 'personal', '43', '2022-04-25', '06:22:12'),
(240, 'OKE', '45', '43,45', 'TES', 'group', '45,43', '2022-04-25', '06:22:13'),
(241, 'bismillah syurga', '44', '44,36,37,38,39,41', 'p', 'group', '44,37,38,39,36', '2022-04-25', '06:23:21'),
(242, 'bismillah syurga', '38', '44,36,37,38,39,41', 'p', 'group', '38,44,39,36', '2022-04-25', '06:24:05'),
(244, '73', '37', '37,36', 'Assalamu\'alaikum', 'personal', '37,36', '2022-04-25', '06:25:35'),
(246, 'bismillah syurga', '36', '44,36,37,38,39,41', 'iya amin', 'group', '36,44,39', '2022-04-25', '06:26:21'),
(247, '73', '36', '36,37', 'Wa\'alaikumussalam Wr. Wbt.', 'personal', '36,37', '2022-04-25', '06:26:40'),
(248, '73', '37', '37,36', 'sesungguhnya setelah kesulitan pasti ada kemudahan', 'personal', '37,36', '2022-04-25', '06:26:50'),
(249, '73', '37', '37,36', 'es kelapa', 'personal', '37,36', '2022-04-25', '06:26:57'),
(250, '78', '38', '38,40', 'bismillah', 'personal', '38,40', '2022-04-25', '06:27:34'),
(251, 'bismillah syurga', '44', '44,36,37,38,39,41', 'Materi SDLC_compressed.pdf', 'group', '44,39,36', '2022-04-25', '06:28:11'),
(252, '57', '29', '29,28', 'selamat malam buk', 'personal', '29,28', '2022-04-25', '10:58:10'),
(253, '57', '29', '29,28', 'selamat malam buk', 'personal', '29,28', '2022-04-25', '20:13:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_collassion`
--

CREATE TABLE `t_collassion` (
  `collassion_id` int(11) NOT NULL,
  `collassion_pelajaran` text NOT NULL,
  `collassion_user` text NOT NULL,
  `collassion_kelas` text NOT NULL,
  `collassion_isi` text NOT NULL,
  `collassion_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_collassion`
--

INSERT INTO `t_collassion` (`collassion_id`, `collassion_pelajaran`, `collassion_user`, `collassion_kelas`, `collassion_isi`, `collassion_tanggal`) VALUES
(1, '1', '8', '1,2,3', '<p>Tentang Collassion Learning</p>\r\n', '2022-03-27');

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
  `diskusi_kelas` text NOT NULL,
  `diskusi_tanggal` date NOT NULL DEFAULT curdate(),
  `diskusi_waktu` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_diskusi`
--

INSERT INTO `t_diskusi` (`diskusi_id`, `diskusi_type`, `diskusi_siswa`, `diskusi_text`, `diskusi_file`, `diskusi_file_type`, `diskusi_view`, `diskusi_where`, `diskusi_kelas`, `diskusi_tanggal`, `diskusi_waktu`) VALUES
(7, 'kelas', '11', 'ok sip', '', '', '11,12,8', '1', '1', '2022-02-15', '12:03:05'),
(32, 'kelas', '12', 'ini file png', '19c9fd78b2f77e04e5045d75b47b46ae.png', 'image', '12,11,8', '1', '1', '2022-02-18', '01:12:55'),
(39, 'kelas', '12', 'ini file txt', '99920c409f91bc0bf293297b2ae4661c.txt', 'text', '12,11,8', '1', '1', '2022-02-18', '01:56:42'),
(44, 'materi', '12', 'ini materi spongebob squarepants', '', '', '12,8,11', '19', '1', '2022-02-18', '21:39:56'),
(47, 'materi', '12', 'iki donat masseh', '311565e9f1def5da46daa62a06d86bce.png', 'image', '12,8,11', '19', '1', '2022-02-18', '21:42:35'),
(51, 'kelompok', '12', 'test gambar kelompok mawar404 masseh', '2579d0949f2473aebe68e3b902361629.png', 'image', '12,8,11', '1', '1', '2022-02-19', '07:47:13'),
(52, 'kelompok', '11', 'test live chat masseh', '', '', '11,12,8', '1', '1', '2022-02-19', '07:47:13'),
(54, 'kelas', '8', 'testing diskusi kelas dari dosen bestie', '', '', '8,11', '1', '1', '2022-04-05', '19:57:34'),
(59, 'materi', '8', 'testing diskusi materi dari dosen bestie', '', '', '8', '19', '1', '2022-04-05', '22:25:46'),
(60, 'kelompok', '8', 'testing diskusi kelompok dari dosen bestie', '', '', '8', '1', '1', '2022-04-05', '22:55:53'),
(61, 'kelas', '28', 'Tools menggambar  diagram UML yang paling mudah pakai apa?', '', '', '28,29,32,30,33,34,36,41,37,43,39,38,45,42,40,44', '9', '9', '2022-04-14', '11:22:30'),
(62, 'materi', '28', 'Bagaimana kita bisa membedakan sistem dengan sistem informasi dengan mudah ?', '', '', '28,29,31,30,33,43,38,45,36,41,44,40,37,39,42', '27', '9', '2022-04-14', '11:24:08'),
(63, 'kelompok', '28', 'Latihan 1-1 tentang karakteristik toko. Boundary nya apa? apakah bangunan toko secara fisik bisa disebut boundary ?', '', '', '28', '4', '9', '2022-04-14', '11:26:07'),
(64, 'kelompok', '31', 'Bisa, tp sebaiknya cantumkan semua yang  bisa dikategorikan sebagai boundary toko. nama toko, alamat toko, nama pemilik. gitu  sih menurut saya ', '', '', '31,32,29,28', '4', '9', '2022-04-17', '03:42:33'),
(65, 'kelompok', '32', 'bener .. jenis toko juga bisa. ada toko sembako, ada toko alat tulis, ada toko kue, ada toko material.. ', '', '', '32,29,28', '4', '9', '2022-04-17', '03:44:22'),
(66, 'kelas', '32', 'saya pakai edraw max. banyak pilihan diagramnya. mau gambar diagram apa aja bisa.', '', '', '32,,30,29,33,34,36,41,37,28,43,39,38,45,42,40,44', '9', '9', '2022-04-17', '03:45:15'),
(67, 'materi', '30', 'lihat alat bantu yang digunakan. kalo pakai komputer dan database itu disebut sistem informasi. selain itu disebut sistem.', '', '', '30,29,33,43,38,45,36,41,44,40,28,37,39,42', '27', '9', '2022-04-17', '03:46:37'),
(68, 'kelompok', '28', 'Bagaimana penapatnya tentang collassion learning-app?', '', '', '28', '5', '9', '2022-04-18', '01:34:41'),
(72, 'kelas', '37', 'es kelapa', '', '', '37,43,38,45,36,42,40,44,28,41,39', '9', '9', '2022-04-25', '05:46:24'),
(73, 'kelas', '43', 'P', '', '', '43,45,41,39,28,36,44,37,38,42,40', '9', '9', '2022-04-25', '05:46:33'),
(74, 'kelompok', '41', 'Test 123 di coba', '', '', '41,40,36,28', '7', '9', '2022-04-25', '05:47:19'),
(75, 'kelas', '40', 'z', '', '', '40,45,41,39,28,36,44,37,38,43,42', '9', '9', '2022-04-25', '05:47:30'),
(76, 'kelas', '44', 'bnn', '', '', '44,45,41,39,28,36,37,38,43,42,40', '9', '9', '2022-04-25', '05:47:33'),
(77, 'kelas', '44', 'bnn', '', '', '44,45,41,39,28,36,37,38,43,42,40', '9', '9', '2022-04-25', '05:47:34'),
(78, 'kelas', '39', 'assalamualaikum warahmatullahiwabarkatuh', '', '', '39,45,41,28,36,44,37,38,43,42,40', '9', '9', '2022-04-25', '05:47:37'),
(79, 'kelas', '38', 'p', '', '', '38,45,37,41,39,28,36,44,43,42,40', '9', '9', '2022-04-25', '05:47:38'),
(80, 'kelas', '42', 'p', '', '', '42,45,37,41,39,28,36,44,38,43,40', '9', '9', '2022-04-25', '05:47:50'),
(81, 'kelas', '41', 'test 123 di coba', '', '', '41,45,39,37,28,36,44,38,43,42,40', '9', '9', '2022-04-25', '05:47:55'),
(82, 'kelas', '36', 'test', '', '', '36,45,39,37,41,28,44,38,43,42,40', '9', '9', '2022-04-25', '05:48:07'),
(83, 'kelas', '38', 'p', '', '', '38,45,39,37,41,28,36,44,43,42,40', '9', '9', '2022-04-25', '05:48:08'),
(84, 'kelas', '42', 'ab', '', '', '42,45,39,37,41,28,36,44,38,43,40', '9', '9', '2022-04-25', '05:48:51'),
(86, 'kelompok', '38', 'p', '', '', '38,42,37,28', '8', '9', '2022-04-25', '05:49:16'),
(87, 'kelas', '41', '*p*', '', '', '41,44,39,36,37,28,38,43,42,45,40', '9', '9', '2022-04-25', '05:49:42'),
(89, 'kelas', '41', '*p*', '', '', '41,44,39,36,37,28,38,43,42,45,40', '9', '9', '2022-04-25', '05:49:50'),
(90, 'materi', '43', 'P', '', '', '43,38,45,36,41,44,40,28,37,39,42', '27', '9', '2022-04-25', '05:50:01'),
(91, 'kelas', '44', 'tes', '', '', '44,39,36,37,28,41,38,43,42,45,40', '9', '9', '2022-04-25', '05:50:07'),
(92, 'materi', '38', 'p', '', '', '38,43,45,36,41,44,40,28,37,39,42', '27', '9', '2022-04-25', '05:50:08'),
(93, 'kelas', '44', 'tes', '', '', '44,39,36,37,28,41,38,43,42,45,40', '9', '9', '2022-04-25', '05:50:36'),
(94, 'materi', '41', 'komponen sistem itu apa aja?', '', '', '41,40,45,36,39,37,28,43,42', '27', '9', '2022-04-25', '05:51:14'),
(95, 'materi', '37', 'sesungguhnya setelah kesulitan pasti ada kemudahan', '', '', '37,40,45,36,39,28,41,43,42', '27', '9', '2022-04-25', '05:52:14'),
(96, 'materi', '44', 'assaamualaikum', '', '', '44,40,45,36,39,37,28,41,43,42', '27', '9', '2022-04-25', '05:52:47'),
(97, 'kelas', '39', 'assalamualaikum warahmatullahiwabarkatuh', '', '', '39,44,37,38,40,36,28', '9', '9', '2022-04-25', '05:53:59'),
(98, 'kelas', '36', 'test', '', '', '36,44,37,38,40,39,28', '9', '9', '2022-04-25', '05:54:00'),
(99, 'kelas', '44', 'hfgcjhk', '', '', '44,37,38,39,40,36,28', '9', '9', '2022-04-25', '05:54:02'),
(100, 'kelas', '41', 'test 123 di coba', '', '', '41,44,37,38,40,36,39,28', '9', '9', '2022-04-25', '05:54:05'),
(101, 'kelas', '28', 'jangan error plis', '', '', '28,45,40,43,41,39,38,37,36', '9', '9', '2022-04-25', '05:54:07'),
(102, 'kelas', '38', 'bismillah', '', '', '38,44,37,40,36,39,28', '9', '9', '2022-04-25', '05:54:12'),
(103, 'kelas', '43', 'CK', '', '', '43,44,37,38,40,36,39,28', '9', '9', '2022-04-25', '05:54:13'),
(104, 'kelas', '37', 'sesungguhnya setelah kesulitan pasti ada kemudahan', '', '', '37,44,38,40,36,39,28', '9', '9', '2022-04-25', '05:54:13'),
(105, 'kelas', '42', 'p', '', '', '42,44,37,38,40,36,39,28', '9', '9', '2022-04-25', '05:54:46'),
(106, 'materi', '36', 'manjadda wajada', '', '', '36,39,37,28,40,45,41,43,42', '27', '9', '2022-04-25', '05:55:17'),
(107, 'materi', '36', 'mansyabara zafira', '', '', '36,39,37,28,40,45,41,43,42', '27', '9', '2022-04-25', '05:55:25'),
(108, 'kelas', '41', 'ini foto', '6b99d08a88d77d68374a26953d68c63f.jpg', 'image', '41,44,37,38,40,36,39,28', '9', '9', '2022-04-25', '05:57:15'),
(109, 'kelas', '43', 'T', '5612acdac50ea6303f89d92f23db6acf.jpg', 'image', '43,44,37,38,40,36,39,28', '9', '9', '2022-04-25', '05:57:58'),
(110, 'materi', '39', 'tugas 1', '43983a1cb330a7effb09aa8fcb259e9e.pdf', 'application', '39,36,37,28,40,45,41,43,42', '27', '9', '2022-04-25', '05:58:12'),
(112, 'kelas', '37', 'apsi', 'c4f711767f678a1aa50427611c74cdc3.pdf', 'application', '37,44,38,40,36,39,28', '9', '9', '2022-04-25', '05:58:13'),
(116, 'kelas', '28', 'baca ya', '0c3d1efae36a5e0c3ce988cfc6035e09.docx', 'application', '28,38,37,39,40,36', '9', '9', '2022-04-25', '05:58:16'),
(117, 'kelas', '28', 'baca ya', 'f113912c685747105599cbdb43b5080d.docx', 'application', '28,38,37,39,40,36', '9', '9', '2022-04-25', '05:58:19'),
(118, 'kelas', '37', 'apsi', 'd53843ec2147136689dec9a5a597fa25.pdf', 'application', '37,44,38,39,40,36,28', '9', '9', '2022-04-25', '05:58:27'),
(119, 'kelas', '37', 'apsi', '398fa4b7f2ff51b992d0cde31161b710.pdf', 'application', '37,44,38,40,36,39,28', '9', '9', '2022-04-25', '05:58:28'),
(120, 'kelas', '28', 'baca ya', '398fa4b7f2ff51b992d0cde31161b710.docx', 'application', '28,38,37,39,40,36', '9', '9', '2022-04-25', '05:58:28'),
(121, 'kelas', '37', 'apsi', '398fa4b7f2ff51b992d0cde31161b710.pdf', 'application', '37,44,38,40,36,39,28', '9', '9', '2022-04-25', '05:58:28'),
(122, 'kelas', '37', 'apsi', 'f146c1e543689bbc691bf97cc9ac7a27.pdf', 'application', '37,44,38,40,36,39,28', '9', '9', '2022-04-25', '05:58:29'),
(123, 'kelas', '37', 'apsi', 'f146c1e543689bbc691bf97cc9ac7a27.pdf', 'application', '37,44,38,40,36,39,28', '9', '9', '2022-04-25', '05:58:29'),
(124, 'kelas', '37', 'apsi', 'f146c1e543689bbc691bf97cc9ac7a27.pdf', 'application', '37,44,40,38,36,39,28', '9', '9', '2022-04-25', '05:58:29'),
(125, 'kelas', '37', 'apsi', '5a0c023de8cc4ffdd980a67b90b2f6ef.pdf', 'application', '37,44,40,38,36,39,28', '9', '9', '2022-04-25', '05:58:43'),
(126, 'kelas', '37', 'apsi', 'e14827c2211590552daea261bb980aa6.pdf', 'application', '37,44,40,38,36,39,28', '9', '9', '2022-04-25', '05:58:44'),
(127, 'kelas', '37', 'apsi', 'e14827c2211590552daea261bb980aa6.pdf', 'application', '37,44,40,38,36,39,28', '9', '9', '2022-04-25', '05:58:44'),
(128, 'materi', '36', 'Logo UTM', 'cb06e03af202e3028f2a26e83e6b7d42.png', 'image', '36,39,37,28,40,45,41,43,42', '27', '9', '2022-04-25', '05:58:57'),
(129, 'kelas', '28', 'baca ya', '06339528e69334c4a559c6f81acabde1.pdf', 'application', '28,37,38,40,36,39', '9', '9', '2022-04-25', '05:59:57'),
(130, 'kelas', '28', 'baca ya', '81ec219425c1953ca19056b35c0b07d7.pdf', 'application', '28,37,38,40,36,39', '9', '9', '2022-04-25', '05:59:58'),
(131, 'materi', '37', 'apsi', '0927ceb90e80d036f503ab1799312569.pdf', 'application', '37,36,28,40,45,41,43,42,39', '27', '9', '2022-04-25', '06:00:12'),
(132, 'kelas', '44', 'materi SDLC', 'a5da2e131414f6e752c17aa8e129a9bf.pdf', 'application', '44,37,38,36,39,28', '9', '9', '2022-04-25', '06:00:23'),
(133, 'kelas', '44', 'materi SDLC', 'fca41ab9482ac0b7b4c896f1fcfca844.pdf', 'application', '44,37,38,36,39,28', '9', '9', '2022-04-25', '06:00:24'),
(134, 'kelas', '44', 'materi SDLC', 'fca41ab9482ac0b7b4c896f1fcfca844.pdf', 'application', '44,37,40,38,36,39,28', '9', '9', '2022-04-25', '06:00:24'),
(135, 'kelas', '44', 'materi SDLC', '1a8a03d89c053410231a8bcef77e0885.pdf', 'application', '44,37,40,38,36,39,28', '9', '9', '2022-04-25', '06:00:25'),
(136, 'kelas', '44', 'Materi SDLC_compressed.pdf', '1d4adc3301b255dae712c2258581ed8c.pdf', 'application', '44,37,40,38,36,39,28', '9', '9', '2022-04-25', '06:00:56'),
(137, 'kelas', '44', 'Materi SDLC_compressed.pdf', 'aaedc9ff89d54e382238463c068103af.pdf', 'application', '44,37,38,36,39,28', '9', '9', '2022-04-25', '06:00:57'),
(138, 'kelas', '37', 'apsi', '8ee51ab1fb670ee169e07c0832b00d96.pdf', 'application', '37,40,38,36,39,28', '9', '9', '2022-04-25', '06:01:53'),
(139, 'materi', '41', 'ini foto aja', '82f83fa9f0c85cdd686afe0be742437e.jpg', 'image', '41,43,39,28', '27', '9', '2022-04-25', '06:02:09'),
(141, 'materi', '41', 'ini foto aja', 'eea5349d32db12698e60f1cc6e2bab73.jpg', 'image', '41,43,39,28', '27', '9', '2022-04-25', '06:02:10'),
(143, 'kelompok', '37', 'Assalamu\'alaikum', '', '', '37,42', '8', '9', '2022-04-25', '06:02:42'),
(144, 'kelompok', '36', 'test', '', '', '36,41,28', '7', '9', '2022-04-25', '06:02:53'),
(145, 'kelompok', '45', 'TES', '', '', '45,39', '9', '9', '2022-04-25', '06:02:53'),
(146, 'kelompok', '43', 'G', '', '', '43,39', '9', '9', '2022-04-25', '06:02:54'),
(148, 'kelompok', '44', 'hay', '', '', '44,39', '9', '9', '2022-04-25', '06:03:13'),
(149, 'kelompok', '36', 'test', '', '', '36,41,28', '7', '9', '2022-04-25', '06:05:21'),
(150, 'kelas', '36', 'test', '', '', '36,39,28', '9', '9', '2022-04-25', '06:10:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_formative`
--

CREATE TABLE `t_formative` (
  `formative_id` text NOT NULL,
  `formative_pelaksanaan` datetime DEFAULT NULL,
  `formative_judul` text NOT NULL,
  `formative_durasi` text NOT NULL,
  `formative_petunjuk` text NOT NULL,
  `formative_jumlah` text NOT NULL,
  `formative_pertanyaan` text NOT NULL,
  `formative_pelajaran` text NOT NULL,
  `formative_kelas` text NOT NULL,
  `formative_tanggal` date DEFAULT NULL,
  `formative_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_formative`
--

INSERT INTO `t_formative` (`formative_id`, `formative_pelaksanaan`, `formative_judul`, `formative_durasi`, `formative_petunjuk`, `formative_jumlah`, `formative_pertanyaan`, `formative_pelajaran`, `formative_kelas`, `formative_tanggal`, `formative_hapus`) VALUES
('SOAL1', '2022-05-16 17:57:00', 'KB 1-1. Konsep Dasar SI', '60', 'Silakan pilih satu jawaban yang paling tepat.', '10', '{\"formative_judul\":\"KB 1-1. Konsep Dasar SI\",\"formative_pelajaran\":\"4\",\"formative_kelas\":[\"9\"],\"formative_pelaksanaan\":\"2022-05-16T17:57\",\"formative_durasi\":\"60\",\"formative_petunjuk\":\"Silakan pilih satu jawaban yang paling tepat.\",\"formative_id\":\"SOAL1\",\"formative_jumlah\":\"10\",\"soal_pertanyaan1\":\"Pernyataan  yang paling benar, adalah : \",\"gambar1\":\"SOAL1_1\",\"a1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa spesifikasi\",\"b1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa perangkat keras dan batasan berupa spesifikasi.\",\"c1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa perangkat lunak.\",\"d1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa perangkat lunak dan batasan berupa spesifikasi.\",\"soal_kunci_jawaban1\":\"A\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Komputer adalah sebuah sistem. Komputer dapat dikategorikan ke dalam beberapa kelompok berikut :\",\"gambar2\":\"SOAL1_2\",\"a2\":\"Fisik, Buatan Manusia, Deterministik, Tertutup.\",\"b2\":\"Fisik, Buatan Manusia, Probabilistik, Tertutup.\",\"c2\":\"Fisik, Buatan Manusia, Deterministik, Terbuka.\",\"d2\":\"Fisik, Buatan Manusia, Probabilistik, Terbuka.\",\"soal_kunci_jawaban2\":\"C\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Perbedaan yang mendasar antara sistem dengan sistem informasi terletak pada komponen :\",\"gambar3\":\"SOAL1_3\",\"a3\":\"Manusia\",\"b3\":\"Alat\",\"c3\":\"Konsep\",\"d3\":\"Prosedur\",\"soal_kunci_jawaban3\":\"B\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Surat Keterangan Aktif Kuliah, adalah sebuah surat keterangan yang berisikan status keaktifan mahasiswa pada tahun akademik berjalan. Surat Keterangan Aktif Kuliah dapat dikategorikan ke dalam suatu informasi karena memenuhi beberapa karakteristik, yaitu :\",\"gambar4\":\"SOAL1_4\",\"a4\":\"Benar, Baru, Penegas\",\"b4\":\"Benar, Baru, Tambahan\",\"c4\":\"Benar, Baru, Korektif.\",\"d4\":\"Benar, Baru.\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Jadwal kuliah diposting pada SIAKAD sejak seminggu sebelum kegiatan perkuliahan di awal semester dimulai, yang dapat diakses oleh mahasiswa di beranda masing-masing. Ini merupakan contoh informasi yang berkualitas karena memenuhi unsur-unsur  :\",\"gambar5\":\"SOAL1_5\",\"a5\":\"Akurat, Relevan\",\"b5\":\"Akurat, Relevan, Tepat Waktu\",\"c5\":\"Akurat, Tepat Waktu, Bernilai\",\"d5\":\"Relevan, Tepat Waktu\",\"soal_kunci_jawaban5\":\"B\",\"soal_input5\":\"text\",\"soal_pertanyaan6\":\"Web Developer bekerja membangun aplikasi sesuai dengan rancangan sistem yang dibuat oleh Analis Sistem. Kegiatan ini dilakukan pada tahap :\",\"gambar6\":\"SOAL1_6\",\"a6\":\"Analisis Sistem\",\"b6\":\"Desain Sistem.\",\"c6\":\"Implementasi Sistem\",\"d6\":\"Pemeliharaan Sistem\",\"soal_kunci_jawaban6\":\"C\",\"soal_input6\":\"text\",\"soal_pertanyaan7\":\"Toko Untung Selalu adalah toko yang menjual alat tulis kantor. Pemilik toko bermaksud untuk membangun aplikasi penjualan online agar dapat memperluas area pemasaran produk yang dijual mengingat selama ini pembeli terbatas dari wilayah sekitar toko saja. Hal ini sesuai dengan alasan perlunya pengembangan sistem, yaitu :\",\"gambar7\":\"SOAL1_7\",\"a7\":\"Adanya masalah pada sistem yang lama\",\"b7\":\"Untuk meraih kesempatan \",\"c7\":\"Adanya instruksi\",\"d7\":\"Pertumbuhan organisasi\",\"soal_kunci_jawaban7\":\"B\",\"soal_input7\":\"text\",\"soal_pertanyaan8\":\"Analis sistem mempelajari prosedur sistem penjualan yang ada pada toko Untung Selalu untuk mengetahui permasalahan yang ada dan mewawancarai pemilik toko untuk mengetahui keinginan\\/kebutuhannya agar dapat memberikan saran perbaikan atau pengembangan yang dapat dilakukan. Kegiatan ini dilakukan pada tahap :\",\"gambar8\":\"SOAL1_8\",\"a8\":\"Analisis Sistem \",\"b8\":\"Desain Sistem\",\"c8\":\"Implementasi Sistem\",\"d8\":\"Pemeliharaan Sistem\",\"soal_kunci_jawaban8\":\"A\",\"soal_input8\":\"text\",\"soal_pertanyaan9\":\"Jika dipandang dari cara mengembangkannya, maka metode pendekatan pengembangan sistem yang paling cocok digunakan dalam melakukan pengembangan sistem penjualan online pada Toko Untung Selalu, adalah :\",\"gambar9\":\"SOAL1_9\",\"a9\":\"Pendekatan Menyeluruh \",\"b9\":\"Pendekatan Lompat Jauh\",\"c9\":\"Pendekatan Sistem\",\"d9\":\"Pendekatan Berkembang\",\"soal_kunci_jawaban9\":\"A\",\"soal_input9\":\"text\",\"soal_pertanyaan10\":\"Mengikuti tahapan di dalam siklus hidup sistem tanpa dibekali dengan alat-alat dan teknik-teknik yang memadai, sehingga pengembangan sistem informasi menjadi sulit dan  keberhasilan sistem kurang terjamin, merupakan ciri-ciri dari pendekatan pengembangan sistem dengan metode :\",\"gambar10\":\"SOAL1_10\",\"a10\":\"Pendekatan Terstruktur\",\"b10\":\"Pendekatan Klasik \",\"c10\":\"Pendekatan Lompat Jauh\",\"d10\":\"Pendekatan Berkembang\",\"soal_kunci_jawaban10\":\"B\",\"soal_input10\":\"text\"}', '4', '9', '2022-05-15', 0),
('SOAL2', '2022-05-16 18:19:00', 'KB 1-2. Metodologi Pengembangan SI', '60', 'Silahkan pilih satu jawaban yang paling tepat', '10', '{\"formative_judul\":\"KB 1-2. Metodologi Pengembangan SI\",\"formative_pelajaran\":\"4\",\"formative_kelas\":[\"9\"],\"formative_pelaksanaan\":\"2022-05-16T18:19\",\"formative_durasi\":\"60\",\"formative_petunjuk\":\"Silahkan pilih satu jawaban yang paling tepat\",\"formative_id\":\"SOAL2\",\"formative_jumlah\":\"10\",\"soal_pertanyaan1\":\"Pengembangan sistem Toko Online Untung Selalu sudah jelas kebutuhannya sejak awal karena pemilik toko telah dapat mendeskripsikan kebutuhannya dengan sangat jelas. Proyek pengembangan ini merupakan proyek berskala kecil sehingga tidak melibatkan personil tim dalam jumlah yang banyak. Berdasarkan hal tersebut maka metode pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar1\":\"SOAL2_1\",\"a1\":\"Prototyping \",\"b1\":\"Agile\",\"c1\":\"Systems Development Life Cycle (SDLC) \",\"d1\":\"Rapid Aplication Development (RAD)\",\"soal_kunci_jawaban1\":\"C\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Seringkali proses bisnis pengguna sistem yang satu dengan yang lain hampir sama sehingga tim pengembang dapat menggunakan sistem informasi yang telah ada untuk dikembangkan menjadi sistem informasi yang baru. Berdasarkan hal tersebut maka metode pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar2\":\"SOAL2_2\",\"a2\":\"Metodologi Pengembangan Berorientasi Pemakaian Ulang (Re-Usable) \",\"b2\":\"Systems Development Life Cycle (SDLC)\",\"c2\":\"Rapid Aplication Development (RAD)\",\"d2\":\"Spiral\",\"soal_kunci_jawaban2\":\"A\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Tim pengembang mendapatkan pesanan untuk melakukan pengembangan sistem informasi untuk sistem yang kompleks sehingga membutuhkan anggota tim pengembang yang sudah berpengalaman dan berkomitmen. Berdasarkan hal tersebut maka metodologi pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar3\":\"SOAL2_3\",\"a3\":\"Object Oriented Analysis and Design (OOAD).\",\"b3\":\"Prototyping.\",\"c3\":\"Scrum.\",\"d3\":\"Agile\",\"soal_kunci_jawaban3\":\"D\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Tim pengembang melibatkan klien (pengguna sistem) untuk mengomentari setiap versi sistem informasi yang dikembangkan sampai dihasilkannya versi yang memenuhi kriteria, hal ini akan berdampak pada :\",\"gambar4\":\"SOAL2_4\",\"a4\":\"Ketepatan waktu penyelesaian proyek pengembangan sistem lebih terjamin\",\"b4\":\"Biaya pengembangan sistem yang lebih besar\",\"c4\":\"Jadwal kerja menjadi tidak menentu.\",\"d4\":\"Kebutuhan jumlah anggota tim pengembang menjadi lebih banyak.\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Menggunakan sistem informasi yang telah ada untuk dikembangkan menjadi sistem informasi yang baru dapat dilakukan untuk sistem dengan proses bisnis yang hampir sama sehingga akan berdampak pada :\",\"gambar5\":\"SOAL2_5\",\"a5\":\"Waktu penyelesaian proyek lebih cepat.\",\"b5\":\"Biaya pengembangan sistem yang lebih besar.\",\"c5\":\"Jumlah anggota tim pengembang yang lebih banyak\",\"d5\":\"Jadwal kerja menjadi tidak menentu.\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\",\"soal_pertanyaan6\":\"Metodologi pengembangan sistem informasi yang paling tepat digunakan untuk menangani masalah yang kompleks karena dapat mentransformasukan bisnis yang sulit diukur menjadi lebih mudah dikembangkan adalah :\",\"gambar6\":\"SOAL2_6\",\"a6\":\"Object Oriented Analysis and Design (OOAD) \",\"b6\":\"Prototyping\",\"c6\":\"Scrum\",\"d6\":\"Agile\",\"soal_kunci_jawaban6\":\"A\",\"soal_input6\":\"text\",\"soal_pertanyaan7\":\"Metodologi pengembangan sistem informasi yang menekankan pada sistem yang mudah dalam menerima perubahan dan mampu beradaptasi dengan cepat, sehingga memungkinkan proyek dapat selesai dengan cepat adalah :\",\"gambar7\":\"SOAL2_7\",\"a7\":\"Rapid Aplication Development (RAD)\",\"b7\":\"Prototyping\",\"c7\":\"Scrum\",\"d7\":\"Agile\",\"soal_kunci_jawaban7\":\"D\",\"soal_input7\":\"text\",\"soal_pertanyaan8\":\"Metodologi pengembangan sistem informasi yang dapat digunakan untuk kebutuhan sistem informasi pengguna (klien) yang berubah sewaktu-waktu adalah : \",\"gambar8\":\"SOAL2_8\",\"a8\":\"Scrum\",\"b8\":\"Spiral\",\"c8\":\"Agile\",\"d8\":\"Rapid Aplication Development (RAD)\",\"soal_kunci_jawaban8\":\"B\",\"soal_input8\":\"text\",\"soal_pertanyaan9\":\"Metodologi pengembangan sistem informasi yang kurang fleksibel terhadap perubahan dikarenakan proses perancangan yang terlalu singkat, adalah :\",\"gambar9\":\"SOAL2_9\",\"a9\":\"Scrum\",\"b9\":\"Prototyping\",\"c9\":\"Agile\",\"d9\":\"Spiral\",\"soal_kunci_jawaban9\":\"B\",\"soal_input9\":\"text\",\"soal_pertanyaan10\":\"Tidak adanya pemisah antara fase analisis dan disain sehingga akan meningkatkan komunikasi antara pengembang dengan klien dari tahap awal sampai akhir adalah kelebihan dari metode pengembangan sistem informasi :\",\"gambar10\":\"SOAL2_10\",\"a10\":\"Rapid Aplication Development (RAD)\",\"b10\":\"Prototyping\",\"c10\":\"Scrum\",\"d10\":\"Object Oriented Analysis and Design (OOAD) \",\"soal_kunci_jawaban10\":\"D\",\"soal_input10\":\"text\"}', '4', '9', '2022-05-15', 0),
('SOAL3', '2022-05-16 19:33:00', 'KB 2-1. Menganalisis Sistem', '60', 'Silahkan pilih satu jawaban yang paling tepat', '10', '{\"formative_judul\":\"KB 2-1. Menganalisis Sistem\",\"formative_pelajaran\":\"4\",\"formative_kelas\":[\"9\"],\"formative_pelaksanaan\":\"2022-05-16T19:33\",\"formative_durasi\":\"60\",\"formative_petunjuk\":\"Silahkan pilih satu jawaban yang paling tepat\",\"formative_id\":\"SOAL3\",\"formative_jumlah\":\"10\",\"soal_pertanyaan1\":\"Kegiatan analisis dilakukan pada bagian penjualan untuk mengetahui jumlah pekerjaan yang bisa diselesaikan selama jangka waktu tertentu dan waktu tanggap yang diberikan pada setiap keterlambatan suatu transaksi yang terjadi. \\r\\nTujuan dari kegiatan ini adalah :\\r\\n\",\"gambar1\":\"SOAL3_1\",\"a1\":\"Mengetahui permasalahan dari aspek performance\",\"b1\":\"Mengetahui permasalahan dari aspek control\",\"c1\":\"Mengetahui permasalahan dari aspek eficiency\",\"d1\":\"Mengetahui permasalahan dari aspek services\",\"soal_kunci_jawaban1\":\"A\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Staf administrasi menginput data yang sama berulang kali adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar2\":\"SOAL3_2\",\"a2\":\"Analisis Performance\",\"b2\":\"Analisis Control\",\"c2\":\"Analisis Eficiency\",\"d2\":\"Analisis Services\",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Sistem informasi tidak mudah digunakan dan sulit dipelajari adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar3\":\"SOAL3_3\",\"a3\":\"Analisis Performance\",\"b3\":\"Analisis Control\",\"c3\":\"Analisis Eficiency\",\"d3\":\"Analisis Services \",\"soal_kunci_jawaban3\":\"D\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Laporan penjualan yang dihasilkan selalu terlambat dan seringkali datanya tidak akurat, adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar4\":\"SOAL3_4\",\"a4\":\"Analisis Performance\",\"b4\":\"Analisis Control\",\"c4\":\"Analisis Eficiency\",\"d4\":\"Analisis Services \",\"soal_kunci_jawaban4\":\"C\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Memastikan bahwa sistem yang baru akan dapat diimplementaskan dengan menggunakan komputer yang telah dimiliki adalah contoh hasil studi kelayakan untuk aspek :\",\"gambar5\":\"SOAL3_5\",\"a5\":\"Teknis\",\"b5\":\"Operasional\",\"c5\":\"Ekonomi\",\"d5\":\"Hukum\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\",\"soal_pertanyaan6\":\"Memastikan bahwa sistem yang baru akan dapat diterima oleh orang-orang yang ada di dalam organisasi adalah contoh hasil studi kelayakan untuk aspek :\",\"gambar6\":\"SOAL3_6\",\"a6\":\"Teknis\",\"b6\":\"Operasional\",\"c6\":\"Ekonomi\",\"d6\":\"Hukum\",\"soal_kunci_jawaban6\":\"B\",\"soal_input6\":\"text\",\"soal_pertanyaan7\":\"Data dikumpulkan oleh tim pengembang dengan mewawancarai bagian penjualan secara langsung untuk mengetahui kendala yang dihadapi dan kebutuhan akan sistem yang baru. Data yang dikumpulkan tersebut akan dijadikan dasar dalam merancang prosedur sistem baru yang akan dikembangkan. Berdasarkan cara memperolehnya, data yang dikumpulkan tersebut dikategorikan ke dalam jenis data :\",\"gambar7\":\"SOAL3_7\",\"a7\":\"Primer\",\"b7\":\"Sekunder\",\"c7\":\"Eksternal\",\"d7\":\"Time Series\",\"soal_kunci_jawaban7\":\"A\",\"soal_input7\":\"text\",\"soal_pertanyaan8\":\"Data diperoleh tim pengembang dari dokumen-dokumen yang dimiliki oleh klien (pengguna) untuk dijadikan acuan dan dasar dalam kegiatan analisis kebutuhan pengguna. Data tersebut dikategorikan ke dalam jenis data :\",\"gambar8\":\"SOAL3_8\",\"a8\":\"Primer\",\"b8\":\"Sekunder\",\"c8\":\"Eksternal\",\"d8\":\"Time Series\",\"soal_kunci_jawaban8\":\"B\",\"soal_input8\":\"text\",\"soal_pertanyaan9\":\"Ketika melakukan pengumpulan data melalui observasi tim pengembang tidak terlibat langsung dengan kegiatan penjualan yang merupakan objek dari sistem informasi yang akan dikembangkan, melainkan hanya melakukan pengamatan terhadap kegiatan yang dilakukan oleh bagian penjualan pada periode waktu tertentu. Kegiatan yang dilakukan oleh tim pengembang tersebut termasuk jenis observasi dengan menggunakan teknik :\",\"gambar9\":\"SOAL3_9\",\"a9\":\"Participant Observation\",\"b9\":\"Non Participant Observation\",\"c9\":\"Time Series Observation\",\"d9\":\"Sekunder  Observation\",\"soal_kunci_jawaban9\":\"B\",\"soal_input9\":\"text\",\"soal_pertanyaan10\":\"Tim pengembang mengumpulkan data yang dibutuhkan dari Bagian Penjualan dari waktu ke waktu agar data yang diperoleh dapat menggambarkan perkembangan dari kegiatan penjualan. Data yang dikumpulkan oleh tim pengembang tersebut ke dalam jenis data :\",\"gambar10\":\"SOAL3_10\",\"a10\":\"Time Series\",\"b10\":\"Cross Section\",\"c10\":\"Eksternal\",\"d10\":\"Sekunder\",\"soal_kunci_jawaban10\":\"A\",\"soal_input10\":\"text\"}', '4', '9', '2022-05-15', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_formative_hasil`
--

CREATE TABLE `t_formative_hasil` (
  `formative_hasil_id` int(11) NOT NULL,
  `formative_hasil_siswa` text NOT NULL,
  `formative_hasil_soal` text NOT NULL,
  `formative_hasil_jawaban` text NOT NULL,
  `formative_hasil_nilai` text NOT NULL,
  `formative_hasil_sisa` text NOT NULL,
  `formative_hasil_tanggal` date DEFAULT curdate(),
  `formative_hasil_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_informasi`
--

CREATE TABLE `t_informasi` (
  `informasi_id` int(11) NOT NULL,
  `informasi_user` text NOT NULL,
  `informasi_mata_kuliah` text NOT NULL,
  `informasi_sks` text NOT NULL,
  `informasi_deskripsi` text NOT NULL,
  `informasi_relevansi` text NOT NULL,
  `informasi_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_informasi`
--

INSERT INTO `t_informasi` (`informasi_id`, `informasi_user`, `informasi_mata_kuliah`, `informasi_sks`, `informasi_deskripsi`, `informasi_relevansi`, `informasi_tanggal`) VALUES
(1, '8', 'Analisis dan Perancangan Sistem Informasi', '3', 'Matakuliah ini mengajarkan tentang kegiatan yang dilakukan pada setiap tahap yang ada di siklus hidup sistem dengan penekanan pada tahap analisis dan perancangan sistem informasi yang dimulai dari konsep dasar pengembangan sistem, metodologi pengembangan sistem, analisis kebutuhan pengguna sistem dan perancangan sistem yang meliputi perancangan alur bisnis dengan menggunakan Flow of Document dan Diagram Unified Modeling Language (UML) berupa Diagram Use Case (Use Case Diagram), Diagram Aktivitas (Activity Diagram), Diagram Urutan (Sequence Diagram) dan Diagram Kelas (Class Diagram), perancangan arsitektur program menggunakan DIagram HIPO VTOC dan perancanga antar muka pengguna.', 'Kompetensi dalam melakukan analisis dan perancangan sistem informasi sangat dibutuhkan oleh mahasiswa di Program Studi Sistem Informasi yang memiliki salah satu profil lulusan sebagai analis sistem sehingga lulusan yang dihasilkan harus memiliki kemampuan dalam merancang dan mengaplikasikan pemrograman komputer sesuai kebutuhan stakeholder. Untuk memiliki kemampuan dalam merancang suatu aplikasi dibutuhkan matakuliah Analisis dan Perancangan Sistem Informasi.', '2022-03-16');

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
(1, 'TKJ 1', 'Teknik Kerja Jaringan 1', 1, '2021-04-05'),
(2, 'ATPH', 'Agribisnis Tanaman Pangan dan Holtikultura', 1, '2021-04-15'),
(3, 'TKJ 2', 'Teknik Kerja Jaringan 2', 1, '2021-04-15'),
(9, 'SI', 'Sistem Informasi', 0, '2022-04-13');

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
(1, 'Mawar 404', '1', '11,12', 1, '2022-02-16'),
(4, '1', '9', '29,31,32', 1, '2022-04-14'),
(5, 'one-to-one', '9', '33,35', 0, '2022-04-17'),
(6, 'buah2an', '9', '34', 1, '2022-04-18'),
(7, 'satu', '9', '36,40,41', 0, '2022-04-24'),
(8, 'dua', '9', '37,38,42', 0, '2022-04-24'),
(9, 'tiga', '9', '39,43,44,45', 0, '2022-04-24'),
(10, '001', '9', '46,47,48,49', 0, '2022-04-25'),
(11, '002', '9', '50,51,52,53', 0, '2022-04-25'),
(12, '003', '9', '54,55,60,62', 0, '2022-04-25'),
(13, '004', '9', '59,61,63,64', 0, '2022-04-26'),
(14, '005', '9', '31,56,57,58', 0, '2022-04-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_latihan`
--

CREATE TABLE `t_latihan` (
  `latihan_id` text NOT NULL,
  `latihan_semester` text NOT NULL,
  `latihan_pertemuan` text NOT NULL,
  `latihan_judul` text NOT NULL,
  `latihan_jenis` set('individu','kelompok') NOT NULL DEFAULT '',
  `latihan_tampil` date DEFAULT NULL,
  `latihan_batas_unggah` datetime DEFAULT NULL,
  `latihan_guru` text NOT NULL,
  `latihan_kelas` text NOT NULL,
  `latihan_pelajaran` text NOT NULL,
  `latihan_jumlah` text NOT NULL,
  `latihan_text` text NOT NULL,
  `latihan_tanggal` date NOT NULL DEFAULT curdate(),
  `latihan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_latihan`
--

INSERT INTO `t_latihan` (`latihan_id`, `latihan_semester`, `latihan_pertemuan`, `latihan_judul`, `latihan_jenis`, `latihan_tampil`, `latihan_batas_unggah`, `latihan_guru`, `latihan_kelas`, `latihan_pelajaran`, `latihan_jumlah`, `latihan_text`, `latihan_tanggal`, `latihan_hapus`) VALUES
('SOAL1', '1', '1', 'Menebak nama gambar', 'individu', '2022-04-03', '2022-04-03 05:24:00', 'SOAL1', '1,2,3', '1', '2', '{\"latihan_jumlah\":\"2\",\"latihan_id\":\"SOAL1\",\"latihan_judul\":\"Menebak nama gambar\",\"latihan_pelajaran\":\"1\",\"latihan_kelas\":[\"1\",\"2\",\"3\"],\"latihan_tampil\":\"2022-04-03\",\"latihan_batas_unggah\":\"2022-04-03T05:24\",\"latihan_jenis\":\"individu\",\"soal1\":\"Gambar apakah ini ?\",\"gambar1\":\"SOAL1_1\",\"soal2\":\"Soal materi ada di file\",\"gambar2\":\"SOAL1_2\",\"file2\":\"SOAL1_2.docx\",\"file1\":null}', '2022-04-03', 0),
('SOAL2', '4', '1', 'KB 1-1. Konsep Dasar SI', 'kelompok', '2022-04-18', '2022-05-16 20:20:00', 'SOAL2', '9', '4', '1', '{\"latihan_jumlah\":\"1\",\"latihan_id\":\"SOAL2\",\"latihan_judul\":\"KB 1-1. Konsep Dasar SI\",\"latihan_pelajaran\":\"4\",\"latihan_kelas\":[\"9\"],\"latihan_tampil\":\"2022-04-18\",\"latihan_batas_unggah\":\"2022-05-16T20:20\",\"latihan_jenis\":\"kelompok\",\"soal1\":\"Sebagai seorang analis sistem, anda diminta untuk menyelesaikan permasalahan yang dialami oleh pemilik toko yang datang untuk berkonsultasi terkait dengan sistem penjualan yang ingin dikembangkannya. Langkah pertama yang harus dilakukan adalah menentukan karakteristik yang membentuk sebuah sistem toko. \\r\\nBagaimanakah karakteristik yang membentuk sebuah sistem Toko?\\r\\n\\r\\nPada latihan ini mahasiswa diminta untuk menentukan dan menjelaskan karakteristik yang membentuk sebuah sistem toko. \\r\\nSilahkan kerjakan latihan tersebut dengan menggunakan langkah-langkah pembelajaran Collassion Learning yang terdapat pada Petunjuk Belajar Modul 1.\\r\\n\",\"gambar1\":\"SOAL2_1\",\"file1\":null}', '2022-04-14', 0),
('SOAL3', '4', '2', 'KB 1-2. Metodologi Pengembangan Sistem', 'kelompok', '2022-04-18', '2022-04-18 10:30:00', 'SOAL3', '9', '4', '1', '{\"latihan_jumlah\":\"1\",\"latihan_id\":\"SOAL3\",\"latihan_judul\":\"KB 1-2. Metodologi Pengembangan Sistem\",\"latihan_pelajaran\":\"4\",\"latihan_kelas\":[\"9\"],\"latihan_tampil\":\"2022-04-18\",\"latihan_batas_unggah\":\"2022-04-18T10:30\",\"latihan_jenis\":\"kelompok\",\"soal1\":\"Sebagai seorang analis sistem, anda merupakan anggota tim pengembang yang bertugas untuk menentukan metodologi pengembangan sistem informasi yang sesuai dengan kondisi dan permintaan klien. Terdapat klien yang merupakan pemilik sebuah toko yang berkeinginan membangun aplikasi toko online untuk memperluas area pemasaran dan meningkatkan penjualan. Agar aplikasi toko online yang diinginkan dapat cepat selesai dan hasilnya sesuai dengan keinginannya, pemilik toko ingin terlibat di dalam kegiatan pengembangan sistem yang dilakukan oleh tim pengembang.\\r\\n\\r\\nSilahkan diskusikan dengan teman-teman di kelompoknya, metodologi pengembangan sistem informasi apa yang paling tepat digunakan untuk permasalahan tersebut dan jelaskan alasannya mengapa memilih metodologi itu.\\r\\nLatihan 1-2 dikerjakan dengan menggunakan langkah-langkah pembelajaran Collassion Learning yang tercantum pada petunjuk belajar Modul 1.\\r\\n\",\"gambar1\":\"SOAL3_1\",\"file1\":null}', '2022-04-18', 0),
('SOAL4', '4', '3', 'KB 2-1. Menganalisis Sistem', 'individu', '2022-04-24', '2022-04-26 09:10:00', 'SOAL4', '9', '4', '1', '{\"latihan_jumlah\":\"1\",\"latihan_id\":\"SOAL4\",\"latihan_judul\":\"KB 2-1. Menganalisis Sistem\",\"latihan_pelajaran\":\"4\",\"latihan_kelas\":[\"9\"],\"latihan_tampil\":\"2022-04-24\",\"latihan_batas_unggah\":\"2022-04-26T09:10\",\"latihan_jenis\":\"individu\",\"soal1\":\"Skripsi adalah karya ilmiah yang disusun oleh mahasiswa program sarjana sebagai salah satu syarat akademik yang wajib dipenuhi di akhir masa studinya. Dalam proses penyusunan skripsi, mahasiswa dibimbing oleh dua dosen pembimbing yang berperan untuk mengarahkan baik dari sisi teknis penulisan mapun kualitas konten dengan jumlah minimal pembimbingan yang telah ditentukan seperti yang tercantum di dalam buku pedoman penulisan skripsi. Tetapi sejak Pademi Covid-19 melanda seluruh dunia sejak awal tahun 2020 membuat banyak kegiatan tidak dapat berjalan seperti biasanya. Kegiatan perkuliahan tatap muka di kelas tidak lagi dapat dilaksanakan dan digantikan dengan perkuliahan yang dilakukan secara daring. Begitu pula dengan proses pembimbingna skripsi yang biasanya dilakukan secara tatap muka dengan dosen pembimbing sesuai dengan jadwal yang telah disepakati menjadi tidak lagi dapat dilakukan karena adanya himbauan dari pemerintah untuk bekerja dan belajar dari rumah sehingga membuat proses pembimbingan menjadi terkendala. Sebagai gantinya proses pembimbingan dilakukan melalui e-mail atau aplikasi WhatsApp, di mana dosen pembimbing akan mengoreksi skripsi, memberi catatan perbaikan dan mengirimkannya kembali kepada mahasiswa. E-mail dan WhatsApp sebagai media dalam proses pembimbingan memang dapat digunakan tetapi akan menyulitkan dosen untuk mengetahui rekaman aktivitas mahasiswa yang dibimbing dan masih memungkinkan file skripsi tercecer atau hilang mengingat jumlah mahasiswa yang dibimbing tidak hanya satu orang. \\r\\n\\r\\nSebagai seorang analis sistem terdapat beberapa kegiatan analisis sistem yang harus anda lakukan, sebagai berikut :\\r\\n1.\\tMenganalisis sistem dengan menggunakan PIECES.\\r\\n2.\\tMenentukan kelemahan dari proses bisnis pada sistem yang ada untuk bisa menentukan kebutuhan dari sistem yang baru\\r\\n3.\\tMenentukan tingkat kelayakan kebutuhan sistem baru tersebut ditinjau dari beberapa aspek, di antara ekonomi, teknik, operasional dan hukum.\\r\\n\",\"gambar1\":\"SOAL4_1\",\"file1\":null}', '2022-04-23', 1),
('SOAL5', '4', '6', 'tes latihan', 'kelompok', '2022-04-25', '2022-04-26 21:55:00', '28', '9', '4', '1', '{\"latihan_jumlah\":\"1\",\"latihan_id\":\"SOAL5\",\"latihan_semester\":\"4\",\"latihan_pertemuan\":\"6\",\"latihan_judul\":\"tes latihan\",\"latihan_pelajaran\":\"4\",\"latihan_kelas\":[\"9\"],\"latihan_tampil\":\"2022-04-25\",\"latihan_batas_unggah\":\"2022-04-26T21:55\",\"latihan_jenis\":\"kelompok\",\"soal1\":\"tes\",\"gambar1\":\"SOAL5_1\"}', '2022-04-25', 1),
('SOAL6', '4', '3', 'KB 2-1. Menganalisis Sistem', 'kelompok', '2022-05-08', '2022-05-08 21:30:00', '28', '9', '4', '1', '{\"latihan_jumlah\":\"1\",\"latihan_id\":\"SOAL6\",\"latihan_semester\":\"4\",\"latihan_pertemuan\":\"3\",\"latihan_judul\":\"KB 2-1. Menganalisis Sistem\",\"latihan_pelajaran\":\"4\",\"latihan_kelas\":[\"9\"],\"latihan_tampil\":\"2022-05-08\",\"latihan_batas_unggah\":\"2022-05-08T21:30\",\"latihan_jenis\":\"kelompok\",\"soal1\":\"Soal Latihan 2-1 dapat diunduh pada file terlampir.\\r\\nSilahkan kerjakan Latihan 2-1 dengan menggunakan langkah-langkah pembelajaran Collassion Learning yang terdapat pada Petunjuk Belajar Modul 2.\",\"gambar1\":\"SOAL6_1\",\"file1\":\"SOAL6_1.pdf\"}', '2022-05-05', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_latihan_hasil`
--

CREATE TABLE `t_latihan_hasil` (
  `latihan_hasil_id` int(11) NOT NULL,
  `latihan_hasil_jenis` text NOT NULL,
  `latihan_hasil_kelompok` text DEFAULT NULL,
  `latihan_hasil_siswa` text NOT NULL,
  `latihan_hasil_soal` text NOT NULL,
  `latihan_hasil_jawaban` text NOT NULL,
  `latihan_hasil_nilai` text NOT NULL,
  `latihan_hasil_nilai_total` text NOT NULL,
  `latihan_hasil_pengkoreksi` text NOT NULL,
  `latihan_hasil_tanggal` date NOT NULL DEFAULT curdate(),
  `latihan_hasil_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_latihan_hasil`
--

INSERT INTO `t_latihan_hasil` (`latihan_hasil_id`, `latihan_hasil_jenis`, `latihan_hasil_kelompok`, `latihan_hasil_siswa`, `latihan_hasil_soal`, `latihan_hasil_jawaban`, `latihan_hasil_nilai`, `latihan_hasil_nilai_total`, `latihan_hasil_pengkoreksi`, `latihan_hasil_tanggal`, `latihan_hasil_hapus`) VALUES
(9, 'individu', NULL, '11', 'SOAL1', '{\"latihan_id\":\"SOAL1\",\"latihan_jumlah\":\"2\",\"latihan_jenis\":\"individu\",\"jawab1\":\"Donat Kentang\",\"jawab2\":\"Jawaban ada di file\",\"jawab2_file\":\"SOAL1_2_jawab.docx\"}', '{\"jumlah\":\"2\",\"nilai1\":\"100\",\"nilai2\":\"80\"}', '180', '8', '2022-04-03', 0),
(10, 'kelompok', '4', '29', 'SOAL2', '{\"latihan_id\":\"SOAL2\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"4\",\"jawab1\":\"Karakteristik sebuah toko meliputi :\\r\\n1. Super sistem : sistem penjualan, sub sistem : bagian penjualan, kasir, bagian gudang, pemilik toko, gedung toko, rak barang, meja kasir, ac, aturan untuk karyawan, jam operasional toko.\\r\\n2. Boundary : nama toko, nama pemilik\\r\\n3. Environment : kondisi perekonomian, kondisi cuaca\\r\\n4. Input : pasokan barang dari suplier\\r\\n5. Proses : transaksi penjualan\\r\\n6. Output : jumlah barang terjual, jumlah uang masuk, jumlah keuntungan\\r\\n7.  Interface : kerjasama dengan suplier\\r\\n8. Sasaran : tercapainya target penjualan\\r\\n\"}', '{\"jumlah\":\"1\",\"nilai1\":\"100\"}', '100', '28', '2022-04-16', 1),
(11, 'kelompok', '5', '33', 'SOAL2', '{\"latihan_id\":\"SOAL2\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"5\",\"jawab1\":\"karakteristik yang dibutuhkan dalam menyelesaikan permasalahan yang dialami oleh pemilik toko yaitu dengan cara menganalisis data dengan baik. \"}', '', '', '', '2022-04-18', 1),
(12, 'kelompok', '6', '34', 'SOAL2', '{\"latihan_id\":\"SOAL2\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"6\",\"jawab1\":\"Karakteristik membentuk sebuah sistem toko:\\r\\n1. Merancang sebuah sistem\\r\\n\"}', '', '', '', '2022-04-18', 1),
(13, 'kelompok', '5', '33', 'SOAL2', '{\"latihan_id\":\"SOAL2\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"5\",\"jawab1\":\"menganalisis sistem dalam menyelesaikan masalah\"}', '', '', '', '2022-04-18', 1),
(14, 'kelompok', '5', '33', 'SOAL3', '{\"latihan_id\":\"SOAL3\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"5\",\"jawab1\":\"menganalisis sistem pengembangan\"}', '{\"jumlah\":\"1\",\"nilai1\":\"70\"}', '70', '28', '2022-04-18', 0),
(15, 'kelompok', '6', '34', 'SOAL3', '{\"latihan_id\":\"SOAL3\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"6\",\"jawab1\":\"Metodelogi pengembangan sistem informasi\"}', '{\"jumlah\":\"1\",\"nilai1\":\"50\",\"saran1\":\"Baca lagi materi yang ada di modul 1. pelajari ciri, kelebihan dan kelemahan dari 9 metodologi yang ada agar dapat menentukan metodologi yang paling tepat dengan permasalahan atau kondisi yang ada\"}', '50', '28', '2022-04-18', 0),
(16, 'individu', NULL, '34', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"skripsi adalah karya ilmiah yang disusun oleh mahasiswa\"}', '{\"jumlah\":\"1\",\"nilai1\":\"80\",\"saran1\":\"ada beberapa analisis yang masih belum lengkap. bisa dibaca kembali modul 2 kb 2.1\"}', '80', '28', '2022-04-23', 0),
(17, 'individu', NULL, '35', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"sitem informasi\"}', '{\"jumlah\":\"1\",\"nilai1\":\"70\",\"saran1\":\"Baca lagi modul 2 ya... untuk aspek PIECES masih belum lengkap\"}', '70', '28', '2022-04-23', 0),
(18, 'individu', NULL, '33', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"1.  menganalisis sistem dengan pieces\\r\\n2.  menentukakan kelembahan dari setiap proses pada sistem\\r\\n3.  serta menentukan kelayakan sistem \"}', '{\"jumlah\":\"1\",\"nilai1\":\"85\",\"saran1\":\"sudah baik tapi masih belum lengkap\"}', '85', '28', '2022-04-23', 0),
(19, 'individu', NULL, '37', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"Sesungguhnya Setelah Kesulitan Pasti Ada Kemudahan\",\"jawab1_file\":\"SOAL4_1_jawab.pdf\"}', '{\"jumlah\":\"1\",\"nilai1\":\"90\",\"saran1\":\"aamiin...\"}', '90', '28', '2022-04-25', 0),
(20, 'individu', NULL, '38', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"\",\"jawab1_file\":\"SOAL4_1_jawab.pdf\"}', '{\"jumlah\":\"1\",\"nilai1\":\"100\",\"saran1\":\"bagus\"}', '100', '28', '2022-04-25', 0),
(21, 'individu', NULL, '39', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"semoga lancar dan barokah\"}', '', '', '', '2022-04-25', 0),
(22, 'individu', NULL, '43', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"OKE\"}', '', '', '', '2022-04-25', 0),
(23, 'individu', NULL, '44', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"sukseeessss\"}', '', '', '', '2022-04-25', 0),
(24, 'individu', NULL, '42', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"\",\"jawab1_file\":\"SOAL4_1_jawab.jpg\"}', '', '', '', '2022-04-25', 0),
(25, 'individu', NULL, '40', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"\",\"jawab1_file\":\"SOAL4_1_jawab.xlsx\"}', '', '', '', '2022-04-25', 0),
(26, 'individu', NULL, '36', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"jawawabnnya apa ya ?\\r\\nbingung :\\/\"}', '', '', '', '2022-04-25', 0),
(27, 'individu', NULL, '41', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"ini jawaban\",\"jawab1_file\":\"SOAL4_1_jawab.jpg\"}', '', '', '', '2022-04-25', 0),
(28, 'individu', NULL, '41', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"ini jawaban\",\"jawab1_file\":\"SOAL4_1_jawab.jpg\"}', '', '', '', '2022-04-25', 0),
(29, 'individu', NULL, '45', 'SOAL4', '{\"latihan_id\":\"SOAL4\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"individu\",\"jawab1\":\"TESTESTESTESTES\",\"jawab1_file\":\"SOAL4_1_jawab.pdf\"}', '', '', '', '2022-04-25', 0),
(30, 'kelompok', '4', '32', 'SOAL2', '{\"latihan_id\":\"SOAL2\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"4\",\"jawab1\":\"Hasil tugas kelompok kami terlampir Bu\",\"jawab1_file\":\"SOAL2_1_jawab.pdf\"}', '{\"jumlah\":\"1\",\"soal\":\"SOAL2\",\"nilai1\":\"70\",\"saran1\":\"masih belum lengkap\",\"koreksi1_file\":\"SOAL2_1_koreksi.pptx\"}', '70', '28', '2022-04-30', 0),
(31, 'kelompok', '10', '46', 'SOAL2', '{\"latihan_id\":\"SOAL2\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"10\",\"jawab1\":\"Karakteristik pembentuk sebuah sistem toko :\\r\\n1.\\tSuper sistem\\t: Sistem Perdagangan\\r\\n       Sub sistem\\t: Kasir, Wiraniaga, Karyawan Gudang, Pemilik Toko\\r\\n2.\\tBoundary\\t: Nama Toko, Alamat, Jenis Toko\\r\\n3.\\tEnvirontment\\t: Kondisi soisal, Ekonomi dan Politik\\r\\n4.\\tInterface\\t: distributor\\r\\n5.\\tInput \\t\\t: barang yang dijual\\r\\n6.\\tProcess\\t: transaksi \\r\\n7.\\tOutput\\t: uang masuk, keuntungan\\r\\n8.\\tGoal\\t\\t: jumlah transaksi sebanyak-banyaknya\\r\\n\"}', '{\"jumlah\":\"1\",\"soal\":\"SOAL2\",\"nilai1\":\"80\",\"saran1\":\"Sub sistem tidak hanya terbatas pada person, tetapi juga barang, gedung dan kelengkapan toko lainnya\"}', '80', '28', '2022-05-16', 0),
(32, 'kelompok', '12', '54', 'SOAL2', '{\"latihan_id\":\"SOAL2\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"12\",\"jawab1\":\"1.\\tSuper sistem\\t: Sistem Perniagaan\\r\\n       Sub sistem\\t: Pemilik toko, pramuniaga, kasir\\r\\n2.\\tBoundary\\t       : Nama Toko, Alamat Toko\\r\\n3.\\tEnvirontment\\t: Tanggal, Trend, Cuaca, Pesaing\\r\\n4.\\tInterface\\t      : supplier  \\r\\n5.\\tInput \\t\\t     : barang dari supplier\\r\\n6.\\tProcess\\t\\t: transaksi  penjualan\\r\\n7.\\tOutput\\t\\t: uang masuk\\r\\n8.\\tGoal\\t\\t       : jumlah transaksi sebanyak-banyaknya\\r\\n\"}', '', '', '', '2022-05-16', 0),
(33, 'kelompok', '13', '59', 'SOAL2', '{\"latihan_id\":\"SOAL2\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"13\",\"jawab1\":\"1.\\tSuper sistem\\t: Sistem Perniagaan\\r\\n        Sub sistem\\t: Pemilik toko, kasir, spg, rak besi, ac, gedung, komputer, meja kasir, barcode scanner\\r\\n2.\\tBoundary  \\t       : Nama Toko, Alamat\\r\\n3.\\tEnvirontment\\t: Cuaca, kondisi ekomomi, trend barang\\r\\n4.\\tInterface\\t       : distributor\\r\\n5.\\tInput \\t\\t       : barang yang dijual\\r\\n6.\\tProcess\\t\\t: transaksi \\r\\n7.\\tOutput\\t\\t: uang masuk, keuntungan\\r\\n8.\\tGoal\\t   \\t       :  keuntungan sebanyak-banyaknya\\r\\n\"}', '', '', '', '2022-05-16', 0),
(34, 'kelompok', '14', '56', 'SOAL2', '{\"latihan_id\":\"SOAL2\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"14\",\"jawab1\":\"1.\\tSuper sistem\\t: Sistem Penjualan\\r\\n        Sub sistem\\t: Kasir, Wiraniaga, Karyawan Gudang, Pemilik Toko, satpam, barang yang dijual, gedung, rak besi, meja kasir, komputer kasir, mesin scaner, ac, kursi, printer\\r\\n2.\\tBoundary\\t: Nama Toko, Alamat, Jenis Toko\\r\\n3.\\tEnvirontment\\t: Kondisi soisal dan ekonomi, demo, cuaca\\r\\n4.\\tInterface\\t: distributor\\r\\n5.\\tInput \\t\\t: barang yang dijual\\r\\n6.\\tProcess\\t\\t: transaksi \\r\\n7.\\tOutput\\t\\t: uang masuk, keuntungan\\r\\n8.\\tGoal\\t\\t: jumlah transaksi sebanyak-banyaknya\\r\\n\"}', '', '', '', '2022-05-16', 0),
(35, 'kelompok', '11', '50', 'SOAL2', '{\"latihan_id\":\"SOAL2\",\"latihan_jumlah\":\"1\",\"latihan_jenis\":\"kelompok\",\"latihan_kelompok\":\"11\",\"jawab1\":\"1.\\tSuper sistem\\t: Sistem Perdagangan\\r\\n      Sub sistem\\t: Kasir, Wiraniaga, Karyawan Gudang, Pemilik Toko, barang yang dijual, sarana dan prasarana toko\\r\\n2.\\tBoundary\\t: Nama Toko, Alamat, Jenis Toko\\r\\n3.\\tEnvirontment\\t: Kondisi soisal dan ekonomi, trend\\r\\n4.\\tInterface\\t: distributor\\r\\n5.\\tInput \\t\\t: barang yang dijual\\r\\n6.\\tProcess\\t\\t: transaksi \\r\\n7.\\tOutput\\t\\t: uang masuk, keuntungan\\r\\n8.\\tGoal\\t\\t: jumlah transaksi sebanyak-banyaknya\\r\\n\"}', '', '', '', '2022-05-16', 0);

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
  `materi_file` text DEFAULT NULL,
  `materi_hapus` int(11) DEFAULT 0,
  `materi_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_materi`
--

INSERT INTO `t_materi` (`materi_id`, `materi_user`, `materi_pelajaran`, `materi_kelas`, `materi_judul`, `materi_isi`, `materi_file`, `materi_hapus`, `materi_tanggal`) VALUES
(19, 5, '1', '1,2,3', 'Menebak nama gambar', '<p>Gambar adalah gambar dan harus di tebak dengan hati yang bersih dan tanpa pamrih</p>\r\n', '5bdb3834d77ee96d1fbd6073aaf47fe3.docx', 0, '2022-03-26'),
(22, 28, '4', '9', 'KB 1-1. Konsep Dasar Sistem dan Sistem Informasi', '<ul>\r\n	<li>Secara terperinci pembahasan pada Kegiatan Belajar (KB)&nbsp;1-1 meliputi : Konsep Sistem, Konsep Informasi, Konsep Sistem Informasi dan Pendekatan Pengembangan Sistem Informasi.</li>\r\n	<li>Tujuan pembelajaran yang secara khusus ingin dicapai dari materi yang ada pada KB 1-1&nbsp; ini adalah <strong>mahasiswa akan mampu menjelaskan konsep dasar sistem informasi dengan benar.</strong></li>\r\n</ul>\r\n', '497823c018b29882f804625e31d28e06.pdf', 1, '2022-04-13'),
(23, 28, '4', '9', 'KB 1-2. Metodologi Pengebangan Sistem Informasi', '<p>Pada Kegiatan Belajar (KB)&nbsp;1-2 materi yang dibahas adalah sembilan metodologi pengembangan sistem informasi beserta kelebihan dan kekurangannya masing-masing.</p>\r\n\r\n<p>Tujuan pembelajaran yang secara khusus ingin dicapai dari mempelajari materi yang ada pada KB 1-2 ini adalah <strong>mahasiswa akan mampu menentukan metodologi pengembangan sistem informasi yang tepat sesuai dengan permasalahan yang diberikan.</strong></p>\r\n', '438939615632cbcede993796c06462ed.pdf', 1, '2022-04-13'),
(24, 28, '4', '9', 'KB 2-1. Menganalisis Sistem', '<ul>\r\n	<li>Pada Kegiatan Belajar (KB) 2-1 materi yang dibahas meliputi : definisi, fungsi, tujuan dan tahapan menganalisis sistem serta metode pengumpulan data.</li>\r\n	<li>Tujuan yang ingin dicapai dari mempelajarai materi yang ada pada KB 2-1 ini adalah <strong>mahasiswa akan mampu merumuskan saran perbaikan dengan logika yang benar.</strong></li>\r\n	<li>Kegiatan analisis sistem adalah kegiatan yang sangat penting, seringkali kegagalan di dalam pengembangan sistem terjadi karena hasil analisis yang tidak tepat.</li>\r\n</ul>\r\n', 'eb6f9f605edf7331fc5c40eafed2404b.pdf', 1, '2022-04-13'),
(25, 28, '4', '9', 'KB 2-2. Merancang Pemodelan Sistem menggunakan Flow of Document', '<ul>\r\n	<li>Pada Kegiatan Belajar 2-2 materi yang dibahas meliputi : merancang sistem, pemodelan sistem dan merancang pemodelan sistem menggunakan <em>Flow of Document</em>.</li>\r\n	<li>Tujuan yang ingin dicapai dari mempelajarai materi yang ada pada KB 2-2&nbsp;ini adalah <strong>mahasiswa akan mampu merancang pemodelan sistem melalui&nbsp;penggunaan <em>Flow of Document</em>&nbsp;dengan&nbsp;benar.</strong></li>\r\n</ul>\r\n', 'bc0655cc0eaf3607585992d3c04f9633.pdf', 1, '2022-04-13'),
(26, 28, '4', '9', 'KB 3-1. Merancang Pemodelan Fungsional dengan Diagram Use Case', '<ul>\r\n	<li>Pada Kegiatan Belajar (KB) 3-1 materi yang dibahas adalah komponen pembentuk Diagram Use Case, petunjuk pembuatan disertai dengan contoh.</li>\r\n	<li>Tujuan yang ingin dicapai dari mempelajaraimateri yang ada pada KB 3-1 ini adalah <strong>mahasiswa akan mampu merancang pemodelan fungsional melalui&nbsp;penggunaan Diagram Use Case dengan&nbsp;benar.</strong></li>\r\n	<li>Pemahaman materi KB 3-1&nbsp;ini sangat dibutuhkan karena untuk menghasilkan sistem informasi/aplikasi yang sesuai dengan kebutuhan pengguna, seorang analis sistem harus memiliki kemampuan dalam merancang sistem yang salah satunya adalah merancang pemodelan fungsional dengan Diagram Use Case.</li>\r\n</ul>\r\n\r\n<ol>\r\n</ol>\r\n', '7e5d399901c35787afdd7c050fd1b672.pdf', 1, '2022-04-13'),
(27, 28, '4', '9', 'KB 1-1. Konsep Dasar Sistem dan Sistem Informasi', '<ul>\r\n	<li>Pembahasan pada Kegiatan Belajar (KB) 1-1 meliputi : Konsep Sistem, Konsep Informasi, Konsep Sistem Informasi dan Pendekatan Pengembangan Sistem Informasi.</li>\r\n	<li>Pemahaman materi KB 1-1&nbsp;ini bermanfaat untuk memahami sistem dan sistem informasi yang merupakan dasar pengambilan keputusan di dalam organisasi khususnya yang terkait dengan kegiatan pengembangan sistem informasi.</li>\r\n	<li>Tujuan pembelajaran yang secara khusus ingin dicapai dari mempelajari materi&nbsp;yang ada pada KB 1-1 ini adalah : <strong>mahasiswa akan mampu menjelaskan konsep dasar sistem informasi dengan benar.</strong></li>\r\n</ul>\r\n', 'a30330b3de5639ef9952770847eb8c1f.pdf', 0, '2022-04-14'),
(28, 28, '4', '9', 'KB 1-2. Metodologi Pengembangan Sistem Informasi', '<ul>\r\n	<li>Materi yang dibahas pada Kegiatan Belajar (KB) 1-2 adalah sembilan metodologi pengembangan sistem informasi beserta kelebihan dan kekurangannya masing-masing.</li>\r\n	<li>Pemahaman materi pada KB 1-2&nbsp;ini bermanfaat untuk memberikan gambaran metodologi pengembangan sistem informasi yang dapat dipilih sesuai dengan keinginan dan sumber daya yang dimiliki oleh klien (pengguna).</li>\r\n	<li>Tujuan pembelajaran yang secara khusus ingin dicapai dari mempelajari materi yang ada pada KB 1-2&nbsp;ini adalah <strong>mahasiswa akan mampu menentukan metodologi pengembangan sistem informasi yang tepat sesuai dengan permasalahan yang diberikan.</strong></li>\r\n</ul>\r\n', '348499477722a8471f25b730ec8288fe.pdf', 0, '2022-04-14'),
(29, 28, '4', '9', 'KB 2-1. Menganalisis Sistem', '<ul>\r\n	<li>Pada Kegiatan Belajar (KB) 2-1 materi yang dibahas meliputi : definisi, fungsi, tujuan dan tahapan menganalisis sistem serta metode pengumpulan data.</li>\r\n	<li>Pemahaman materi KB&nbsp;2-1 ini bermanfaat untuk memahami kegiatan di awal pengembangan sistem yang harus dilakukan oleh tim pengembang sistem, yang dalam hal ini adalah analis sistem. Di dalam penerapan sebuah sistem seringkali timbul permasalahan seperti ketidakpraktisan, pengarsipan yang buruk, kinerja yang lambat, layanan yang tidak memuaskan dan hal lain yang menyebabkan adanya keinginan pemilik (pengguna) sistem untuk melakukan pengembangan sistem. Kegiatan analisis sistem adalah kegiatan yang sangat penting, seringkali kegagalan di dalam pengembangan sistem terjadi karena hasil analisis yang tidak tepat.</li>\r\n	<li>Tujuan yang ingin dicapai dari mempelajarai materi&nbsp;yang ada pada KB 2-1 ini adalah <strong>mahasiswa akan mampu merumuskan saran perbaikan dengan logika yang benar.</strong></li>\r\n</ul>\r\n', '2664c5dc5bd3eede2e854ed7a455c2b6.pdf', 0, '2022-04-14'),
(30, 28, '4', '9', 'KB 2-2. Merancang Pemodelan Sistem menggunakan Flow of Document', '<ul>\r\n	<li>Pada KB 2-2 materi yang dibahas meliputi : merancang sistem, pemodelan sistem dan merancang pemodelan sistem menggunakan <em>Flow of Document</em>.</li>\r\n	<li>Pemodelan sistem dengan menggunakan Flow of Document akan digunakan sebagai acuan dalam tahapan perancangan berikutnya sehingga dibutuhkan logika yang kuat di dalam memahami hasil analisis pada kegiatan sebelumnya, karena kesalahan alur dan logika di dalam perancangan pemodelan sistem akan mempengaruhi alur dan logika dalam perancangan pemodelan&nbsp;lainnya.</li>\r\n	<li>Tujuan yang ingin dicapai dari mempelajarai materi&nbsp;yang ada pada KB 2-2 ini adalah <strong>mahasiswa akan mampu merancang pemodelan sistem melalui penggunaan <em>Flow of Document</em> dengan benar.</strong></li>\r\n</ul>\r\n', '959f1d473cba87f27e2e7b7bcf6125ae.pdf', 0, '2022-04-14'),
(31, 28, '4', '9', 'KB 3-1. Merancang Pemodelan Fungsional dengan Diagram Use Case', '<ul>\r\n	<li>Tujuan dilakukannya perancangan dengan menggunakan Diagram UML&nbsp;yaitu untuk menyajikan <em>tool</em> analisis, desain, dan implementasi sistem berbasis <em>software</em> bagi para programmer, memudahkan programmer untuk menciptakan sistem yang hendak dirancang, memudahkan programmer agar dapat memahami <em>flow</em> atau alur sebuah sistem dan memudahkan programmer untuk memahami perangkat apa saja yang dibutuhkan dalam sistem yang akan dibuat/dikembangkan.&nbsp;Diagram UML terdiri atas 8 diagram, salah satunya adalah Diagram Use Case.</li>\r\n	<li>Pada Kegiatan Belajar 3-1 materi yang dibahas adalah komponen pembentuk Diagram Use Case, petunjuk pembuatan disertai dengan contoh.</li>\r\n	<li>Pemahaman materi pada KB 3-1 ini sangat dibutuhkan karena untuk menghasilkan program (sistem informasi/aplikasi) yang sesuai dengan kebutuhan pengguna, seorang analis sistem harus memiliki kemampuan dalam merancang sistem yang salah satunya adalah merancang&nbsp;pemodelan fungsional.</li>\r\n	<li>Tujuan yang ingin dicapai dari mempelajarai materi&nbsp;yang ada pada KB 3-1&nbsp;ini adalah <strong>mahasiswa akan mampu merancang pemodelan fungsional melalui penggunaan Diagram Use Case dengan benar.</strong></li>\r\n</ul>\r\n', 'da95aafc015e8ca52e94d20a1eb6ca52.pdf', 0, '2022-04-14'),
(32, 28, '4', '9', 'KB 3-2. Merancang Pemodelan Proses Bisnis Menggunakan Diagram Aktivitas', '<ul>\r\n	<li>Diagram UML&nbsp;yaitu untuk menyajikan <em>tool</em> analisis, desain, dan implementasi sistem berbasis <em>software</em> bagi para programmer, memudahkan programmer untuk menciptakan sistem yang hendak dirancang, memudahkan programmer agar dapat memahami <em>flow</em> atau alur sebuah sistem dan memudahkan programmer untuk memahami perangkat apa saja yang dibutuhkan dalam sistem yang akan dibuat/dikembangkan. Diagram UML terdiri atas 8 diagram, salah satunya adalah Diagram Aktivitas.</li>\r\n	<li>Pada Kegiatan Belajar 3-2 materi yang dibahas adalah komponen pembentuk Diagram Aktivitas, petunjuk pembuatan disertai dengan contoh.</li>\r\n	<li>Pemahaman materi KB 3-2&nbsp;ini sangat dibutuhkan karena untuk menghasilkan program (sistem informasi/aplikasi) yang sesuai dengan kebutuhan pengguna, seorang analis sistem harus memiliki kemampuan dalam merancang sistem yang salah satunya adalah pemodelan proses.</li>\r\n	<li>Tujuan yang ingin dicapai dari mempelajarai materi&nbsp;yang ada pada KB 3-2 ini adalah <strong>mahasiswa akan mampu merancang pemodelan proses bisnis melalui penggunaan Diagram Aktivitas dengan benar.</strong></li>\r\n</ul>\r\n', '54bd80e88ec2dd7ee29e6924b1c0e87e.pdf', 0, '2022-04-14'),
(33, 28, '4', '9', 'KB 3-3. Merancang Pemodelan Perilaku Menggunakan DIagram Urutan', '<ul>\r\n	<li>Diagram UML&nbsp;yaitu untuk menyajikan <em>tool</em> analisis, desain, dan implementasi sistem berbasis <em>software</em> bagi para programmer, memudahkan programmer untuk menciptakan sistem yang hendak dirancang, memudahkan programmer agar dapat memahami <em>flow</em> atau alur sebuah sistem dan memudahkan programmer untuk memahami perangkat apa saja yang dibutuhkan dalam sistem yang akan dibuat/dikembangkan. Diagram UML terdiri atas 8 diagram, salah satunya adalah Diagram Urutan.</li>\r\n	<li>Pada Kegiatan Belajar (KB) 3-3 materi yang dibahas adalah komponen pembentuk Diagram Urutan, petunjuk pembuatan disertai dengan contoh.</li>\r\n	<li>Pemahaman materi pada KB 3-3&nbsp;ini sangat dibutuhkan karena untuk menghasilkan program (sistem informasi/aplikasi) yang sesuai dengan kebutuhan pengguna, seorang analis sistem harus memiliki kemampuan dalam merancang sistem yang salah satunya adalah pemodelan perilaku.</li>\r\n	<li>Tujuan yang ingin dicapai dari mempelajarai materi&nbsp;yang ada pada KB 3-3 ini adalah <strong>mahasiswa akan mampu merancang pemodelan perilaku melalui penggunaan Diagram Urutan dengan benar.</strong></li>\r\n</ul>\r\n', '66c3cd13054f28a97b0a1d53a23b4078.pdf', 0, '2022-04-14'),
(34, 28, '4', '9', 'KB 3-4. Merancang Pemodelan Struktural Menggunakan Diagram Kelas', '<ul>\r\n	<li>Diagram UML&nbsp;yaitu untuk menyajikan <em>tool</em> analisis, desain, dan implementasi sistem berbasis <em>software</em> bagi para programmer, memudahkan programmer untuk menciptakan sistem yang hendak dirancang, memudahkan programmer agar dapat memahami <em>flow</em> atau alur sebuah sistem dan memudahkan programmer untuk memahami perangkat apa saja yang dibutuhkan dalam sistem yang akan dibuat/dikembangkan. Diagram UML terdiri atas 8 diagram, salah satunya adalah Diagram Kelas.</li>\r\n	<li>Pada Kegiatan Belajar 3-4 materi yang dibahas adalah komponen pembentuk Diagram Kelas, petunjuk pembuatan disertai dengan contoh.</li>\r\n	<li>Pemahaman materi pada KB 3-4 ini sangat dibutuhkan karena untuk menghasilkan program (sistem informasi/aplikasi) yang sesuai dengan kebutuhan pengguna, seorang analis sistem harus memiliki kemampuan dalam merancang sistem yang salah satunya adalah&nbsp;pemodelan struktural.</li>\r\n	<li>Tujuan yang ingin dicapai dari mempelajarai materiyang ada pada KB 3-4&nbsp;ini adalah <strong>mahasiswa akan mampu merancang pemodelan struktural melalui penggunaan Diagram Kelas dengan benar.</strong></li>\r\n</ul>\r\n', '72816d50f2191b1c19747f7de17856c5.pdf', 0, '2022-04-14'),
(35, 28, '4', '9', 'KB 4-1. Merancang Arsitektur Program', '<ul>\r\n	<li>Secara terperinci pembahasan pada Kegiatan Belajar (KB) 4-1 meliputi : petunjuk pembuatan rancangan arsitektur program dengan Diagram HIPO disertai contoh pembuatannya.</li>\r\n	<li>Pemahaman materi pada KB&nbsp;4-1 ini sangat dibutuhkan karena untuk menjadi seorang analis sistem selain kemampuan dalam menganalisis dan merancang pemodelan sistem, juga dituntut untuk memiliki kemampuan dalam merancang program komputer.</li>\r\n	<li>Tujuan pembelajaran yang secara khusus ingin dicapai dari mempelajari materi yang ada padaKB 4-1 ini adalah <strong>mahasiswa akan mampu merancang Arsitektur Program dengan logika yang benar.</strong></li>\r\n</ul>\r\n', '5eca4ce24feed9e71c62e29ae4e995a2.pdf', 0, '2022-04-14'),
(36, 28, '4', '9', 'KB 4-2. Merancang Antar Muka Pengguna', '<ul>\r\n	<li>Pada Kegiatan Belajar 4-2 materi yang dibahas adalah pengertian, karakteristik dan prinsip-prinsip disain antar muka pengguna disertai contoh pembuatannya.</li>\r\n	<li>Pemahaman materi pada KB 4-2 ini sangat dibutuhkan karena untuk menjadi seorang analis sistem selain kemampuan dalam menganalisis dan merancang pemodelan sistem, juga dituntut untuk memiliki kemampuan dalam merancang program komputer.</li>\r\n	<li>Tujuan pembelajaran yang secara khusus ingin dicapai dari mempelajari materi&nbsp;yang ada pada KB 4-2 ini adalah <strong>mahasiswa akan mampu merancang Tampilan Layar dengan logika yang benar.</strong></li>\r\n</ul>\r\n', 'd4bbbbdd30dd6d921487a38a816e0d33.pdf', 0, '2022-04-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_modul`
--

CREATE TABLE `t_modul` (
  `modul_id` int(11) NOT NULL,
  `modul_user` text NOT NULL,
  `modul_pelajaran` text NOT NULL,
  `modul_kelas` text NOT NULL,
  `modul_judul` text NOT NULL,
  `modul_isi` text NOT NULL,
  `modul_file` text NOT NULL,
  `modul_hapus` int(11) NOT NULL DEFAULT 0,
  `modul_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_modul`
--

INSERT INTO `t_modul` (`modul_id`, `modul_user`, `modul_pelajaran`, `modul_kelas`, `modul_judul`, `modul_isi`, `modul_file`, `modul_hapus`, `modul_tanggal`) VALUES
(1, '5', '1', '1,2,3', 'test modul', '<p>test modul</p>\r\n', 'f52ef74255427ce29f4ff518b6d7aedc.docx', 0, '2022-03-24'),
(2, '28', '4', '9', 'Modul 1', '<p>Pada Modul 1 ini akan dibahas mengenai konsep dasar sistem dan sistem informasi, yang pembahasannya dibagi ke dalam dua Kegiatan Belajar (KB) yaitu :</p>\r\n\r\n<p>KB 1-1 : &nbsp;&nbsp;Konsep Dasar Sistem Informasi.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Secara terperinci pembahasan pada KB 1-1 meliputi : Konsep Sistem, Konsep Informasi, Konsep Sistem Informasi dan Pendekatan Pengembangan Sistem Informasi.</p>\r\n\r\n<p>KB 1-2 : &nbsp;Metodologi Pengembangan Sistem.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pada KB 1-2 materi yang dibahas adalah sembilan metodologi pengembangan sistem informasi beserta kelebihan dan kekurangannya masing-masing.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Pemahaman materi Modul 1 ini bermanfaat untuk memahami sistem dan sistem informasi yang merupakan dasar pengambilan keputusan di dalam organisasi khususnya yang terkait dengan kegiatan pengembangan sistem informasi.</p>\r\n\r\n<p>Tujuan pembelajaran yang secara khusus ingin dicapai dari mempelajari materi-materi yang ada pada Modul 1 ini adalah :</p>\r\n\r\n<ol>\r\n	<li>Mahasiswa akan mampu menjelaskan konsep dasar sistem informasi dengan benar.</li>\r\n	<li>Mahasiswa akan mampu menentukan metodologi pengembangan sistem informasi yang tepat sesuai dengan permasalahan yang diberikan.</li>\r\n</ol>\r\n', 'aa34b37f3cd548adb33294340c57add3.pdf', 1, '2022-04-17'),
(3, '28', '4', '9', 'Modul 1', '<p>Pada Modul 1 ini akan dibahas mengenai konsep dasar sistem dan sistem informasi, yang pembahasannya dibagi ke dalam dua Kegiatan Belajar (KB) yaitu :</p>\r\n\r\n<p>KB 1-1 : &nbsp;&nbsp;Konsep Dasar Sistem Informasi.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Secara terperinci pembahasan pada KB 1-1 meliputi : Konsep Sistem, Konsep Informasi, Konsep Sistem Informasi dan Pendekatan Pengembangan Sistem Informasi.</p>\r\n\r\n<p>KB 1-2 : &nbsp;Metodologi Pengembangan Sistem.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Pada KB 1-2 materi yang dibahas adalah sembilan metodologi pengembangan sistem informasi beserta kelebihan dan kekurangannya masing-masing.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Pemahaman materi Modul 1 ini bermanfaat untuk memahami sistem dan sistem informasi yang merupakan dasar pengambilan keputusan di dalam organisasi khususnya yang terkait dengan kegiatan pengembangan sistem informasi.</p>\r\n\r\n<p>Tujuan pembelajaran yang secara khusus ingin dicapai dari mempelajari materi-materi yang ada pada Modul 1 ini adalah :</p>\r\n\r\n<ol>\r\n	<li>Mahasiswa akan mampu menjelaskan konsep dasar sistem informasi dengan benar.</li>\r\n	<li>Mahasiswa akan mampu menentukan metodologi pengembangan sistem informasi yang tepat sesuai dengan permasalahan yang diberikan.</li>\r\n</ol>\r\n', 'f607aedbb73fbce7eeda20235dec0643.pdf', 0, '2022-04-18'),
(4, '28', '4', '9', 'Modul 2', '<p>Pada Modul 2 ini akan dibahas mengenai kegiatan analisis dan pemodelan sistem, yang pembahasannya dibagi ke dalam dua Kegiatan Belajar (KB) yaitu :</p>\r\n\r\n<p>KB 2-1 : &nbsp;&nbsp;Menganalisis Sistem</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pada KB 2-1 materi yang dibahas meliputi : definisi, fungsi, tujuan dan tahapan menganalisis sistem serta metode pengumpulan data.</p>\r\n\r\n<p>KB 2-2 : &nbsp;&nbsp;Merancang Pemodelan Sistem menggunakan <em>Flow of Document</em></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pada KB 2-2 materi yang dibahas meliputi : merancang sistem, pemodelan sistem dan merancang pemodelan sistem menggunakan <em>Flow of Document</em>.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Pemahaman materi Modul 2 ini bermanfaat untuk memahami kegiatan di awal pengembangan sistem yang harus dilakukan oleh tim pengembang sistem, yang dalam hal ini adalah analis sistem. Di dalam penerapan sebuah sistem seringkali timbul permasalahan seperti ketidakpraktisan, pengarsipan yang buruk, kinerja yang lambat, layanan yang tidak memuaskan dan hal lain yang menyebabkan adanya keinginan pemilik (pengguna) sistem untuk melakukan pengembangan sistem. Kegiatan analisis sistem adalah kegiatan yang sangat penting, seringkali kegagalan di dalam pengembangan sistem terjadi karena hasil analisis yang tidak tepat.</p>\r\n\r\n<p>Tujuan yang ingin dicapai dari mempelajarai materi-materi yang ada pada Modul 2 ini adalah :</p>\r\n\r\n<ol>\r\n	<li>Mahasiswa akan mampu merumuskan saran perbaikan dengan logika yang benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan sistem melalui penggunaan <em>Flow of Document</em> dengan<strong> </strong>benar.</li>\r\n</ol>\r\n', '33785ca91b3e101f9ae7817e93186edc.pdf', 0, '2022-04-18'),
(5, '28', '4', '9', 'Modul 3', '<p>Pada Modul 3 ini akan dibahas mengenai perancangan sistem informasi menggunakan Diagram UML (<em>Unified Modeling Language</em>). UML&nbsp;digunakan untuk memodelkan suatu&nbsp;sistem&nbsp;(bukan hanya perangkat lunak) yang menggunakan konsep berorientasi object. Tujuan dilakukannya perancangan dengan menggunakan Diagram UML&nbsp;yaitu untuk menyajikan <em>tool</em> analisis, desain, dan implementasi sistem berbasis <em>software</em> bagi para programmer, memudahkan programmer untuk menciptakan sistem yang hendak dirancang, memudahkan programmer agar dapat memahami <em>flow</em> atau alur sebuah sistem dan memudahkan programmer untuk memahami perangkat apa saja yang dibutuhkan dalam sistem yang akan dibuat/dikembangkan. Pembahasan di dalam Modul 3 ini dibagi ke dalam empat Kegiatan Belajar (KB), yaitu :</p>\r\n\r\n<p>KB 3-1&nbsp; : &nbsp;Merancang pemodelan fungsional menggunakan Diagram Use Case</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pada KB-1 materi yang dibahas adalah komponen pembentuk Diagram Use Case, petunjuk pembuatan disertai dengan contoh.</p>\r\n\r\n<p>KB 3-2&nbsp;&nbsp; : Merancang pemodelan proses bisnis menggunakan Diagram Aktivitas</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Pada KB-2 materi yang dibahas adalah komponen pembentuk Diagram Aktivitas, petunjuk pembuatan disertai dengan contoh.</p>\r\n\r\n<p>KB 3-3&nbsp;&nbsp; : Merancang pemodelan perilaku menggunakan Diagram Urutan.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Pada KB-3 materi yang dibahas adalah komponen pembentuk Diagram Urutan, petunjuk pembuatan disertai dengan contoh.</p>\r\n\r\n<p>KB 3-4&nbsp;&nbsp; : Merancang pemodelan struktural menggunakan Diagram Kelas.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pada KB-4 materi yang dibahas adalah komponen pembentuk Diagram Kelas, petunjuk pembuatan disertai dengan contoh.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Pemahaman materi Modul 3 ini sangat dibutuhkan karena untuk menghasilkan program (sistem informasi/aplikasi) yang sesuai dengan kebutuhan pengguna, seorang analis sistem harus memiliki kemampuan dalam merancang sistem baik untuk pemodelan fungsional, pemodelan proses, pemodelan perilaku maupun pemodelan struktural.</p>\r\n\r\n<p>Tujuan yang ingin dicapai dari mempelajarai materi-materi yang ada pada Modul 3 ini adalah :</p>\r\n\r\n<ol>\r\n	<li>Mahasiswa akan mampu merancang pemodelan fungsional melalui penggunaan Diagram Use Case dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan proses bisnis melalui penggunaan Diagram Aktivitas dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan perilaku melalui penggunaan Diagram Urutan dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan struktural melalui penggunaan Diagram Kelas dengan<strong> </strong>benar.</li>\r\n</ol>\r\n', '89ea25664a575773e7a1eb9f19b9e478.pdf', 0, '2022-04-18'),
(6, '28', '4', '9', 'Modul 4', '<p>Pada Modul 4 ini akan dibahas mengenai merancang program komputer, yang pembahasannya dibagi ke dalam dua Kegiatan Belajar (KB) yaitu :</p>\r\n\r\n<p>KB 4-1 : &nbsp;Merancang Arsitektur Program.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Secara terperinci pembahasan pada KB 4-1 meliputi : Petunjuk pembuatan rancangan arsitektur program dengan Diagram HIPO disertai contoh pembuatannya.</p>\r\n\r\n<p>KB 4-2 : &nbsp;Merancang Antar Muka Pengguna.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pada KB 4-2 materi yang dibahas adalah pengertian, karakteristik dan prinsip-prinsip disain antar muka pengguna disertai contoh pembuatannya.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Pemahaman materi Modul 4 ini sangat dibutuhkan karena untuk menjadi seorang analis sistem selain kemampuan dalam menganalisis dan merancang pemodelan sistem, juga dituntut untuk memiliki kemampuan dalam merancang program komputer.</p>\r\n\r\n<p>Tujuan pembelajaran yang secara khusus ingin dicapai dari mempelajari materi-materi yang ada pada Modul 4 ini adalah :</p>\r\n\r\n<ol>\r\n	<li>Mahasiswa akan mampu merancang Arsitektur Program dengan<strong> </strong>logika yang benar.</li>\r\n	<li>Mahasiswa akan mampu merancang Tampilan Layar dengan<strong> </strong>logika yang benar.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n', '514d3b27dc572f836ccc91fe90dd023a.pdf', 0, '2022-04-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_panduan`
--

CREATE TABLE `t_panduan` (
  `panduan_id` int(11) NOT NULL,
  `panduan_video` text NOT NULL,
  `panduan_file` text NOT NULL,
  `panduan_for` set('dosen','mahasiswa') NOT NULL DEFAULT '',
  `panduan_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_panduan`
--

INSERT INTO `t_panduan` (`panduan_id`, `panduan_video`, `panduan_file`, `panduan_for`, `panduan_tanggal`) VALUES
(1, '-', 'panduan_dosen.pdf', 'dosen', '2022-04-18'),
(2, '-', 'panduan_mahasiswa.pdf', 'mahasiswa', '2022-04-18');

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
(1, '-', 1, '2021-04-05'),
(2, 'Web Design', 0, '2021-11-28'),
(4, 'Analisis dan Perancangan Sistem Informasi', 0, '2022-04-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pertemuan`
--

CREATE TABLE `t_pertemuan` (
  `pertemuan_id` int(11) NOT NULL,
  `pertemuan_no` text NOT NULL,
  `pertemuan_semester` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pertemuan`
--

INSERT INTO `t_pertemuan` (`pertemuan_id`, `pertemuan_no`, `pertemuan_semester`) VALUES
(102, '1', '4'),
(103, '2', '4'),
(104, '3', '4'),
(105, '4', '4'),
(106, '5', '4'),
(107, '6', '4'),
(108, '7', '4'),
(109, '8', '4'),
(110, '9', '4'),
(111, '10', '4'),
(112, '11', '4'),
(113, '12', '4'),
(114, '13', '4'),
(115, '14', '4'),
(116, '15', '4'),
(117, '16', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_peta`
--

CREATE TABLE `t_peta` (
  `peta_id` int(11) NOT NULL,
  `peta_pelajaran` text NOT NULL,
  `peta_user` text NOT NULL,
  `peta_kelas` text NOT NULL,
  `peta_isi` text NOT NULL,
  `peta_file` text NOT NULL,
  `peta_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_peta`
--

INSERT INTO `t_peta` (`peta_id`, `peta_pelajaran`, `peta_user`, `peta_kelas`, `peta_isi`, `peta_file`, `peta_tanggal`) VALUES
(1, '1', '8', '1,2,3', '<ul>\r\n	<li>Berikut ini adalah Peta Kompetensi Mata Kuliah Analisis dan Peracangan Sistem Informasi.</li>\r\n	<li>Peta Kompetensi ini berisi kompetensi yang dimiliki oleh mahasiswa pada setiap kegiatan belajar.</li>\r\n</ul>\r\n', '2b9b050c9345b325adf4f151614b3f5b.pdf', '2022-03-26'),
(2, '4', '28', '9', '<ul>\r\n	<li>Berikut adalah peta kompetensi mata kuliah Analisis dan Perancangan Sistem Informasi.</li>\r\n	<li>Peta kompetensi ini menggambarkan kompetensi yang diharapkan dapat dimiliki oleh mahasiswa pada setiap kegiatan belajar.</li>\r\n</ul>\r\n', '0034dd09208d453527d17a3d2544acca.pdf', '2022-04-13');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_post`
--

CREATE TABLE `t_post` (
  `post_id` text NOT NULL,
  `post_judul` text NOT NULL,
  `post_semester` text NOT NULL,
  `post_pertemuan` text NOT NULL,
  `post_pelaksanaan` datetime DEFAULT NULL,
  `post_durasi` text NOT NULL,
  `post_kesempatan` int(11) NOT NULL DEFAULT 2,
  `post_petunjuk` text NOT NULL,
  `post_jumlah` text NOT NULL,
  `post_pertanyaan` text NOT NULL,
  `post_pelajaran` text NOT NULL,
  `post_kelas` text NOT NULL,
  `post_tanggal` date DEFAULT NULL,
  `post_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_post`
--

INSERT INTO `t_post` (`post_id`, `post_judul`, `post_semester`, `post_pertemuan`, `post_pelaksanaan`, `post_durasi`, `post_kesempatan`, `post_petunjuk`, `post_jumlah`, `post_pertanyaan`, `post_pelajaran`, `post_kelas`, `post_tanggal`, `post_hapus`) VALUES
('SOAL1', 'KB 2-1. Menganalisis Sistem', '4', '3', '2022-04-25 10:56:00', '10', 2, 'Silakan pilih satu jawaban yang paling tepat', '5', '{\"post_semester\":\"4\",\"post_pertemuan\":\"3\",\"post_judul\":\"KB 2-1. Menganalisis Sistem\",\"post_pelajaran\":\"4\",\"post_kelas\":[\"9\"],\"post_pelaksanaan\":\"2022-04-25T10:56\",\"post_durasi\":\"10\",\"post_petunjuk\":\"Silakan pilih satu jawaban yang paling tepat\",\"post_id\":\"SOAL1\",\"post_jumlah\":\"5\",\"soal_pertanyaan1\":\"Staf administrasi menginput data yang sama berulang kali adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar1\":\"SOAL1_1\",\"a1\":\"Analisis Performance\",\"b1\":\"Analisis Control\",\"c1\":\"Analisis Eficiency\",\"d1\":\"Analisis Services\",\"soal_kunci_jawaban1\":\"D\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Laporan penjualan yang dihasilkan selalu terlambat dan seringkali datanya tidak akurat, adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar2\":\"SOAL1_2\",\"a2\":\"Analisis Performance\",\"b2\":\"Analisis Information\",\"c2\":\"Analisis Eficiency\",\"d2\":\"Analisis Services\",\"soal_kunci_jawaban2\":\"C\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Memastikan bahwa sistem yang baru akan dapat diimplementaskan dengan menggunakan komputer yang telah dimiliki adalah contoh hasil studi kelayakan untuk aspek :\",\"gambar3\":\"SOAL1_3\",\"a3\":\"Teknis\",\"b3\":\"Operasional\",\"c3\":\"Ekonomi\",\"d3\":\"Hukum\",\"soal_kunci_jawaban3\":\"A\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Memastikan bahwa sistem yang baru akan dapat diterima oleh orang-orang yang ada di dalam organisasi adalah contoh hasil studi kelayakan untuk aspek :\",\"gambar4\":\"SOAL1_4\",\"a4\":\"Teknis\",\"b4\":\"Operasional\",\"c4\":\"Ekonomi\",\"d4\":\"Hukum\",\"soal_kunci_jawaban4\":\"B\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Data dikumpulkan oleh tim pengembang dengan mewawancarai bagian penjualan secara langsung untuk mengetahui kendala yang dihadapi dan kebutuhan akan sistem yang baru. Data yang dikumpulkan tersebut akan dijadikan dasar dalam merancang prosedur sistem baru yang akan dikembangkan. Berdasarkan cara memperolehnya, data yang dikumpulkan tersebut dikategorikan ke dalam jenis data :\",\"gambar5\":\"SOAL1_5\",\"a5\":\"Primer\",\"b5\":\"Sekunder\",\"c5\":\"Eksternal\",\"d5\":\"Time Series \",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\"}', '4', '9', '2022-04-25', 1),
('SOAL2', 'KB 1-1. Konsep Dasar SI', '4', '1', '2022-05-06 20:35:00', '20', 2, 'Silakan pilih satu jawaban yang paling tepat.', '5', '{\"post_judul\":\"KB 1-1. Konsep Dasar SI\",\"post_pelajaran\":\"4\",\"post_kelas\":[\"9\"],\"post_pelaksanaan\":\"2022-05-06T20:35\",\"post_durasi\":\"20\",\"post_kesempatan\":\"2\",\"post_petunjuk\":\"Silakan pilih satu jawaban yang paling tepat.\",\"post_id\":\"SOAL2\",\"post_jumlah\":\"5\",\"soal_pertanyaan1\":\"Pernyataan berikut ini yang paling benar, adalah : \",\"gambar1\":\"SOAL2_1\",\"a1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa spesifikasi.\",\"b1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa perangkat keras dan batasan berupa spesifikasi.\",\"c1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa perangkat lunak.\",\"d1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa perangkat lunak dan batasan berupa spesifikasi.\",\"soal_kunci_jawaban1\":\"A\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Surat Keterangan Aktif Kuliah, adalah sebuah surat keterangan yang berisikan status keaktifan mahasiswa pada tahun akademik berjalan. Surat Keterangan Aktif Kuliah dapat dikategorikan ke dalam suatu informasi karena memenuhi beberapa karakteristik, yaitu :\",\"gambar2\":\"SOAL2_2\",\"a2\":\"Benar, Baru, Penegas\",\"b2\":\"Benar, Baru, Tambahan\",\"c2\":\"Benar, Baru, Korektif\",\"d2\":\"Benar, Baru.\",\"soal_kunci_jawaban2\":\"A\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Toko Untung Selalu adalah toko yang menjual alat tulis kantor. Pemilik toko bermaksud untuk membangun aplikasi penjualan online agar dapat memperluas area pemasaran produk yang dijual mengingat selama ini pembeli terbatas dari wilayah sekitar toko saja. Hal ini sesuai dengan alasan perlunya pengembangan sistem, yaitu :\",\"gambar3\":\"SOAL2_3\",\"a3\":\"Adanya masalah pada sistem yang lama\",\"b3\":\"Untuk meraih kesempatan \",\"c3\":\"Adanya instruksi\",\"d3\":\"Pertumbuhan organisasi\",\"soal_kunci_jawaban3\":\"B\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Analis sistem mempelajari prosedur sistem penjualan yang ada pada toko Untung Selalu untuk mengetahui permasalahan yang ada dan mewawancarai pemilik toko untuk mengetahui keinginan\\/kebutuhannya agar dapat memberikan saran perbaikan atau pengembangan yang dapat dilakukan. Kegiatan ini dilakukan pada tahap :\",\"gambar4\":\"SOAL2_4\",\"a4\":\"Analisis Sistem \",\"b4\":\"Desain Sistem\",\"c4\":\"Implementasi Sistem\",\"d4\":\"Pemeliharaan Sistem\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Jika dipandang dari cara mengembangkannya, maka metode pendekatan pengembangan sistem yang paling cocok digunakan dalam melakukan pengembangan sistem penjualan online pada sebuah toko kecil, adalah :\",\"gambar5\":\"SOAL2_5\",\"a5\":\"Pendekatan Menyeluruh \",\"b5\":\"Pendekatan Lompat Jauh\",\"c5\":\"Pendekatan Sistem\",\"d5\":\"Pendekatan Berkembang\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\"}', '4', '9', '2022-05-05', 1),
('SOAL3', 'KB 1-2. Metodologi Pengembangan SI', '4', '2', '2022-05-07 00:00:00', '20', 2, 'Silahkan pilih satu jawaban yang paling tepat', '5', '{\"post_semester\":\"4\",\"post_pertemuan\":\"2\",\"post_judul\":\"KB 1-2. Metodologi Pengembangan SI\",\"post_pelajaran\":\"4\",\"post_kelas\":[\"9\"],\"post_pelaksanaan\":\"2022-05-07T00:00\",\"post_durasi\":\"20\",\"post_petunjuk\":\"Silahkan pilih satu jawaban yang paling tepat\",\"post_id\":\"SOAL3\",\"post_jumlah\":\"5\",\"soal_pertanyaan1\":\"Pengembangan sistem Toko Online Untung Selalu sudah jelas kebutuhannya sejak awal karena pemilik toko telah dapat mendeskripsikan kebutuhannya dengan sangat jelas. Proyek pengembangan ini merupakan proyek berskala kecil sehingga tidak melibatkan personil tim dalam jumlah yang banyak. Berdasarkan hal tersebut maka metode pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar1\":\"SOAL3_1\",\"a1\":\"Prototyping\",\"b1\":\"Agile\",\"c1\":\"Systems Development Life Cycle (SDLC)\",\"d1\":\"Rapid Aplication Development (RAD)\",\"soal_kunci_jawaban1\":\"C\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Tim pengembang mendapatkan pesanan untuk melakukan pengembangan sistem informasi untuk sistem yang kompleks sehingga membutuhkan anggota tim pengembang yang sudah berpengalaman dan berkomitmen. Berdasarkan hal tersebut maka metodologi pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar2\":\"SOAL3_2\",\"a2\":\"Object Oriented Analysis and Design (OOAD).\",\"b2\":\"Prototyping\",\"c2\":\"Scrum\",\"d2\":\"Agile\",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Tim pengembang melibatkan klien (pengguna sistem) untuk mengomentari setiap versi sistem informasi yang dikembangkan sampai dihasilkannya versi yang memenuhi kriteria, hal ini akan berdampak pada :\\r\\n\",\"gambar3\":\"SOAL3_3\",\"a3\":\"Ketepatan waktu penyelesaian proyek pengembangan sistem lebih terjamin\",\"b3\":\"Biaya pengembangan sistem menjadi lebih besar. \",\"c3\":\"Jadwal kerja menjadi tidak menentu\",\"d3\":\"Kebutuhan jumlah anggota tim pengembang menjadi lebih banyak.\",\"soal_kunci_jawaban3\":\"A\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Menggunakan sistem informasi yang telah ada untuk dikembangkan menjadi sistem informasi yang baru dapat dilakukan untuk sistem dengan proses bisnis yang hampir sama sehingga akan berdampak pada :\",\"gambar4\":\"SOAL3_4\",\"a4\":\"Waktu penyelesaian proyek lebih cepat\",\"b4\":\"Biaya pengembangan sistem yang lebih besar\",\"c4\":\"Jumlah anggota tim pengembang yang lebih banyak\",\"d4\":\"Jadwal kerja menjadi tidak menentu\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Metodologi pengembangan sistem informasi yang paling tepat digunakan untuk menangani masalah yang kompleks karena dapat mentransformasukan bisnis yang sulit diukur menjadi lebih mudah dikembangkan adalah :\",\"gambar5\":\"SOAL3_5\",\"a5\":\"Object Oriented Analysis and Design (OOAD)\",\"b5\":\"Prototyping\",\"c5\":\"Scrum\",\"d5\":\"Agile\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\"}', '4', '9', '2022-05-05', 1),
('SOAL4', 'KB 2-1. Menganalisis Sistem', '4', '3', '2022-05-08 00:00:00', '20', 2, 'Silahkan pilih satu jawaban yang paling tepat', '5', '{\"post_semester\":\"4\",\"post_pertemuan\":\"3\",\"post_judul\":\"KB 2-1. Menganalisis Sistem\",\"post_pelajaran\":\"4\",\"post_kelas\":[\"9\"],\"post_pelaksanaan\":\"2022-05-08T00:00\",\"post_durasi\":\"20\",\"post_petunjuk\":\"Silahkan pilih satu jawaban yang paling tepat\",\"post_id\":\"SOAL4\",\"post_jumlah\":\"5\",\"soal_pertanyaan1\":\"Staf administrasi menginput data yang sama berulang kali adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar1\":\"SOAL4_1\",\"a1\":\"Analisis Performance\",\"b1\":\"Analisis Control\",\"c1\":\"Analisis Eficiency\",\"d1\":\"Analisis Services \",\"soal_kunci_jawaban1\":\"D\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Sistem informasi tidak mudah digunakan dan sulit dipelajari adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar2\":\"SOAL4_2\",\"a2\":\"Analisis Performance\",\"b2\":\"Analisis Control\",\"c2\":\"Analisis Eficiency\",\"d2\":\"Analisis Services \",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Laporan penjualan yang dihasilkan selalu terlambat dan seringkali datanya tidak akurat, adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar3\":\"SOAL4_3\",\"a3\":\"Analisis Performance\",\"b3\":\"Analisis Information\",\"c3\":\"Analisis Eficiency\",\"d3\":\"Analisis Services \",\"soal_kunci_jawaban3\":\"C\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Memastikan bahwa sistem yang baru akan dapat diterima oleh orang-orang yang ada di dalam organisasi adalah contoh hasil studi kelayakan untuk aspek :\",\"gambar4\":\"SOAL4_4\",\"a4\":\"Teknis\",\"b4\":\"Operasional\",\"c4\":\"Ekonomi\",\"d4\":\"Hukum\",\"soal_kunci_jawaban4\":\"B\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Tim pengembang mengumpulkan data yang dibutuhkan dari Bagian Penjualan dari waktu ke waktu agar data yang diperoleh dapat menggambarkan perkembangan dari kegiatan penjualan. Data yang dikumpulkan oleh tim pengembang tersebut ke dalam jenis data :\",\"gambar5\":\"SOAL4_5\",\"a5\":\"Time series \",\"b5\":\"Cross section \",\"c5\":\"Eksternal\",\"d5\":\"Sekunder\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\"}', '4', '9', '2022-05-05', 1),
('SOAL5', 'KB 2-2. Merancang Pemodelan Sistem Dengan Flow of Document', '4', '1', '2022-05-09 00:00:00', '20', 2, 'Silahkan pilih satu jawaban yang paling tepat', '5', '{\"post_semester\":\"4\",\"post_pertemuan\":\"1\",\"post_judul\":\"KB 2-2. Merancang Pemodelan Sistem Dengan Flow of Document\",\"post_pelajaran\":\"4\",\"post_kelas\":[\"9\"],\"post_pelaksanaan\":\"2022-05-09T00:00\",\"post_durasi\":\"20\",\"post_petunjuk\":\"Silahkan pilih satu jawaban yang paling tepat\",\"post_id\":\"SOAL5\",\"post_jumlah\":\"5\",\"soal_pertanyaan1\":\"Simbol yang tepat untuk huruf b adalah :\",\"gambar1\":\"SOAL5_1\",\"soal_kunci_jawaban1\":\"D\",\"soal_input1\":\"image\",\"soal_pertanyaan2\":\"Simbol yang tepat untuk huruf d adalah :\",\"gambar2\":\"SOAL5_2\",\"soal_kunci_jawaban2\":\"A\",\"soal_input2\":\"image\",\"soal_pertanyaan3\":\"Huruf a, b dan c pada gambar Flow of Document di atas adalah pihak-pihak yang terlibat langsung dengan sistem, sebagai berikut :\",\"gambar3\":\"SOAL5_3\",\"a3\":\"a=Pelanggan   b=Kasir    c=Pemilik Toko \",\"b3\":\"a=Bagian Penjualan   b=Kasir    c=Pemilik Toko\",\"c3\":\"a=Kasir   b=Pelanggan    c=Pemilik Toko\",\"d3\":\"a=Pelanggan   b=Pemilik Toko   c=Bagian Penjualan\",\"soal_kunci_jawaban3\":\"A\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Nama yang tepat untuk simbol dengan huruf f adalah :\",\"gambar4\":\"SOAL5_4\",\"a4\":\"Slip Penjualan \",\"b4\":\"Membuat Slip Penjualan\",\"c4\":\"Mencetak Slip Penjualan\",\"d4\":\"Memberi stempel pada Slip Penjualan\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Simbol yang tepat untuk huruf g adalah :\",\"gambar5\":\"SOAL5_5\",\"soal_kunci_jawaban5\":\"B\",\"soal_input5\":\"image\"}', '4', '9', '2022-05-05', 1),
('SOAL6', 'KB 1-1. Konsep Dasar SI', '4', '1', '2022-05-16 09:05:00', '60', 2, 'Silakan pilih satu jawaban yang paling tepat.', '10', '{\"post_judul\":\"KB 1-1. Konsep Dasar SI\",\"post_pelajaran\":\"4\",\"post_kelas\":[\"9\"],\"post_pelaksanaan\":\"2022-05-16T09:05\",\"post_durasi\":\"60\",\"post_kesempatan\":\"2\",\"post_petunjuk\":\"Silakan pilih satu jawaban yang paling tepat.\",\"post_id\":\"SOAL6\",\"post_jumlah\":\"10\",\"soal_pertanyaan1\":\"Pernyataan yang paling benar, adalah : \",\"gambar1\":\"SOAL6_1\",\"a1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa spesifikasi\",\"b1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa perangkat keras dan batasan berupa spesifikasi\",\"c1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa perangkat lunak.\",\"d1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa perangkat lunak dan batasan berupa spesifikasi.\",\"soal_kunci_jawaban1\":\"A\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Komputer adalah sebuah sistem. Komputer dapat dikategorikan ke dalam beberapa kelompok berikut :\",\"gambar2\":\"SOAL6_2\",\"a2\":\"Fisik, Buatan Manusia, Deterministik, Tertutup.\",\"b2\":\"Fisik, Buatan Manusia, Probabilistik, Tertutup.\",\"c2\":\"Fisik, Buatan Manusia, Deterministik, Terbuka.\",\"d2\":\"Fisik, Buatan Manusia, Probabilistik, Terbuka.\",\"soal_kunci_jawaban2\":\"C\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Perbedaan yang mendasar antara sistem dengan sistem informasi terletak pada komponen :\",\"gambar3\":\"SOAL6_3\",\"a3\":\"Manusia\",\"b3\":\"Alat\",\"c3\":\"Konsep\",\"d3\":\"Prosedur\",\"soal_kunci_jawaban3\":\"B\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Surat Keterangan Aktif Kuliah, adalah sebuah surat keterangan yang berisikan status keaktifan mahasiswa pada tahun akademik berjalan. Surat Keterangan Aktif Kuliah dapat dikategorikan ke dalam suatu informasi karena memenuhi beberapa karakteristik, yaitu :\",\"gambar4\":\"SOAL6_4\",\"a4\":\"Benar, Baru, Penegas\",\"b4\":\"Benar, Baru, Tambahan\",\"c4\":\"Benar, Baru, Korektif.\",\"d4\":\"Benar, Baru.\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Jadwal kuliah diposting pada SIAKAD sejak seminggu sebelum kegiatan perkuliahan di awal semester dimulai, yang dapat diakses oleh mahasiswa di beranda masing-masing. Ini merupakan contoh informasi yang berkualitas karena memenuhi unsur-unsur  :\",\"gambar5\":\"SOAL6_5\",\"a5\":\"Akurat, Relevan\",\"b5\":\"Akurat, Relevan, Tepat Waktu\",\"c5\":\"Akurat, Tepat Waktu, Bernilai\",\"d5\":\"Relevan, Tepat Waktu\",\"soal_kunci_jawaban5\":\"B\",\"soal_input5\":\"text\",\"soal_pertanyaan6\":\"Web Developer bekerja membangun aplikasi sesuai dengan rancangan sistem yang dibuat oleh Analis Sistem. Kegiatan ini dilakukan pada tahap :\",\"gambar6\":\"SOAL6_6\",\"a6\":\"Analisis Sistem\",\"b6\":\"Desain Sistem.\",\"c6\":\"Implementasi Sistem\",\"d6\":\"Pemeliharaan Sistem\",\"soal_kunci_jawaban6\":\"C\",\"soal_input6\":\"text\",\"soal_pertanyaan7\":\"Toko Untung Selalu adalah toko yang menjual alat tulis kantor. Pemilik toko bermaksud untuk membangun aplikasi penjualan online agar dapat memperluas area pemasaran produk yang dijual mengingat selama ini pembeli terbatas dari wilayah sekitar toko saja. Hal ini sesuai dengan alasan perlunya pengembangan sistem, yaitu :\",\"gambar7\":\"SOAL6_7\",\"a7\":\"Adanya masalah pada sistem yang lama\",\"b7\":\"Untuk meraih kesempatan \",\"c7\":\"Adanya instruksi\",\"d7\":\"Pertumbuhan organisasi\",\"soal_kunci_jawaban7\":\"B\",\"soal_input7\":\"text\",\"soal_pertanyaan8\":\"Analis sistem mempelajari prosedur sistem penjualan yang ada pada toko Untung Selalu untuk mengetahui permasalahan yang ada dan mewawancarai pemilik toko untuk mengetahui keinginan\\/kebutuhannya agar dapat memberikan saran perbaikan atau pengembangan yang dapat dilakukan. Kegiatan ini dilakukan pada tahap :\",\"gambar8\":\"SOAL6_8\",\"a8\":\"Analisis Sistem \",\"b8\":\"Desain Sistem\",\"c8\":\"Implementasi Sistem\",\"d8\":\"Pemeliharaan Sistem\",\"soal_kunci_jawaban8\":\"A\",\"soal_input8\":\"text\",\"soal_pertanyaan9\":\"Jika dipandang dari cara mengembangkannya, maka metode pendekatan pengembangan sistem yang paling cocok digunakan dalam melakukan pengembangan sistem penjualan online pada Toko Untung Selalu, adalah :\",\"gambar9\":\"SOAL6_9\",\"a9\":\"Pendekatan Menyeluruh \",\"b9\":\"Pendekatan Lompat Jauh\",\"c9\":\"Pendekatan Sistem\",\"d9\":\"Pendekatan Berkembang\",\"soal_kunci_jawaban9\":\"A\",\"soal_input9\":\"text\",\"soal_pertanyaan10\":\"Mengikuti tahapan di dalam siklus hidup sistem tanpa dibekali dengan alat-alat dan teknik-teknik yang memadai, sehingga pengembangan sistem informasi menjadi sulit dan  keberhasilan sistem kurang terjamin, merupakan ciri-ciri dari pendekatan pengembangan sistem dengan metode :\",\"gambar10\":\"SOAL6_10\",\"a10\":\"Pendekatan Terstruktur\",\"b10\":\"Pendekatan Klasik \",\"c10\":\"Pendekatan Lompat Jauh\",\"d10\":\"Pendekatan Berkembang\",\"soal_kunci_jawaban10\":\"B\",\"soal_input10\":\"text\"}', '4', '9', '2022-05-15', 0),
('SOAL7', 'KB 1-2. Metodologi Pengembangan SI', '4', '2', '2022-05-16 13:00:00', '60', 2, 'Silahkan pilih satu jawaban yang paling tepat', '10', '{\"post_judul\":\"KB 1-2. Metodologi Pengembangan SI\",\"post_pelajaran\":\"4\",\"post_kelas\":[\"9\"],\"post_pelaksanaan\":\"2022-05-16T13:00:00\",\"post_durasi\":\"60\",\"post_kesempatan\":\"2\",\"post_petunjuk\":\"Silahkan pilih satu jawaban yang paling tepat\",\"post_id\":\"SOAL7\",\"post_jumlah\":\"10\",\"soal_pertanyaan1\":\"Pengembangan sistem Toko Online Untung Selalu sudah jelas kebutuhannya sejak awal karena pemilik toko telah dapat mendeskripsikan kebutuhannya dengan sangat jelas. Proyek pengembangan ini merupakan proyek berskala kecil sehingga tidak melibatkan personil tim dalam jumlah yang banyak. Berdasarkan hal tersebut maka metode pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar1\":\"SOAL7_1\",\"a1\":\"Prototyping \",\"b1\":\"Agile\",\"c1\":\"Systems Development Life Cycle (SDLC) \",\"d1\":\"Rapid Aplication Development (RAD)\",\"soal_kunci_jawaban1\":\"C\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Seringkali proses bisnis pengguna sistem yang satu dengan yang lain hampir sama sehingga tim pengembang dapat menggunakan sistem informasi yang telah ada untuk dikembangkan menjadi sistem informasi yang baru. Berdasarkan hal tersebut maka metode pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar2\":\"SOAL7_2\",\"a2\":\"Metodologi Pengembangan Berorientasi Pemakaian Ulang (Re-Usable) \",\"b2\":\"Systems Development Life Cycle (SDLC)\",\"c2\":\"Rapid Aplication Development (RAD)\",\"d2\":\"Spiral\",\"soal_kunci_jawaban2\":\"A\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Tim pengembang mendapatkan pesanan untuk melakukan pengembangan sistem informasi untuk sistem yang kompleks sehingga membutuhkan anggota tim pengembang yang sudah berpengalaman dan berkomitmen. Berdasarkan hal tersebut maka metodologi pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar3\":\"SOAL7_3\",\"a3\":\"Object Oriented Analysis and Design (OOAD).\",\"b3\":\"Prototyping.\",\"c3\":\"Scrum.\",\"d3\":\"Agile\",\"soal_kunci_jawaban3\":\"D\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Tim pengembang melibatkan klien (pengguna sistem) untuk mengomentari setiap versi sistem informasi yang dikembangkan sampai dihasilkannya versi yang memenuhi kriteria, hal ini akan berdampak pada :\",\"gambar4\":\"SOAL7_4\",\"a4\":\"Ketepatan waktu penyelesaian proyek pengembangan sistem lebih terjamin\",\"b4\":\"Biaya pengembangan sistem yang lebih besar\",\"c4\":\"Jadwal kerja menjadi tidak menentu.\",\"d4\":\"Kebutuhan jumlah anggota tim pengembang menjadi lebih banyak.\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Menggunakan sistem informasi yang telah ada untuk dikembangkan menjadi sistem informasi yang baru dapat dilakukan untuk sistem dengan proses bisnis yang hampir sama sehingga akan berdampak pada :\",\"gambar5\":\"SOAL7_5\",\"a5\":\"Waktu penyelesaian proyek lebih cepat\",\"b5\":\"Biaya pengembangan sistem yang lebih besar.\",\"c5\":\"Jumlah anggota tim pengembang yang lebih banyak\",\"d5\":\"Jadwal kerja menjadi tidak menentu.\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\",\"soal_pertanyaan6\":\"Metodologi pengembangan sistem informasi yang paling tepat digunakan untuk menangani masalah yang kompleks karena dapat mentransformasukan bisnis yang sulit diukur menjadi lebih mudah dikembangkan adalah :\",\"gambar6\":\"SOAL7_6\",\"a6\":\"Object Oriented Analysis and Design (OOAD) \",\"b6\":\"Prototyping\",\"c6\":\"Scrum\",\"d6\":\"Agile\",\"soal_kunci_jawaban6\":\"A\",\"soal_input6\":\"text\",\"soal_pertanyaan7\":\"Metodologi pengembangan sistem informasi yang menekankan pada sistem yang mudah dalam menerima perubahan dan mampu beradaptasi dengan cepat, sehingga memungkinkan proyek dapat selesai dengan cepat adalah :\",\"gambar7\":\"SOAL7_7\",\"a7\":\"Rapid Aplication Development (RAD)\",\"b7\":\"Prototyping\",\"c7\":\"Scrum\",\"d7\":\"Agile\",\"soal_kunci_jawaban7\":\"D\",\"soal_input7\":\"text\",\"soal_pertanyaan8\":\"Metodologi pengembangan sistem informasi yang dapat digunakan untuk kebutuhan sistem informasi pengguna (klien) yang berubah sewaktu-waktu adalah : \",\"gambar8\":\"SOAL7_8\",\"a8\":\"Scrum\",\"b8\":\"Spiral\",\"c8\":\"Agile\",\"d8\":\"Rapid Aplication Development (RAD)\",\"soal_kunci_jawaban8\":\"B\",\"soal_input8\":\"text\",\"soal_pertanyaan9\":\"Metodologi pengembangan sistem informasi yang kurang fleksibel terhadap perubahan dikarenakan proses perancangan yang terlalu singkat, adalah :\",\"gambar9\":\"SOAL7_9\",\"a9\":\"Scrum\",\"b9\":\"Prototyping\",\"c9\":\"Agile\",\"d9\":\"Spiral\",\"soal_kunci_jawaban9\":\"B\",\"soal_input9\":\"text\",\"soal_pertanyaan10\":\"Tidak adanya pemisah antara fase analisis dan disain sehingga akan meningkatkan komunikasi antara pengembang dengan klien dari tahap awal sampai akhir adalah kelebihan dari metode pengembangan sistem informasi :\",\"gambar10\":\"SOAL7_10\",\"a10\":\"Rapid Aplication Development (RAD)\",\"b10\":\"Prototyping\",\"c10\":\"Scrum\",\"d10\":\"Object Oriented Analysis and Design (OOAD) \",\"soal_kunci_jawaban10\":\"D\",\"soal_input10\":\"text\"}', '4', '9', '2022-05-15', 0),
('SOAL8', 'KB 2-1. Menganalisis Sistem', '4', '3', '2022-05-16 18:45:00', '60', 2, 'Silahkan pilih satu jawaban yang paling tepat', '10', '{\"post_judul\":\"KB 2-1. Menganalisis Sistem\",\"post_pelajaran\":\"4\",\"post_kelas\":[\"9\"],\"post_pelaksanaan\":\"2022-05-16T18:45\",\"post_durasi\":\"60\",\"post_kesempatan\":\"2\",\"post_petunjuk\":\"Silahkan pilih satu jawaban yang paling tepat\",\"post_id\":\"SOAL8\",\"post_jumlah\":\"10\",\"soal_pertanyaan1\":\"Kegiatan analisis dilakukan pada bagian penjualan untuk mengetahui jumlah pekerjaan yang bisa diselesaikan selama jangka waktu tertentu dan waktu tanggap yang diberikan pada setiap keterlambatan suatu transaksi yang terjadi. \\r\\nTujuan dari kegiatan ini adalah :\\r\\n\",\"gambar1\":\"SOAL8_1\",\"a1\":\"Mengetahui permasalahan dari aspek performance\",\"b1\":\"Mengetahui permasalahan dari aspek control\",\"c1\":\"Mengetahui permasalahan dari aspek eficiency\",\"d1\":\"Mengetahui permasalahan dari aspek services\",\"soal_kunci_jawaban1\":\"A\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Staf administrasi menginput data yang sama berulang kali adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar2\":\"SOAL8_2\",\"a2\":\"Analisis Performance\",\"b2\":\"Analisis Control\",\"c2\":\"Analisis Eficiency\",\"d2\":\"Analisis Services \",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Sistem informasi tidak mudah digunakan dan sulit dipelajari adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar3\":\"SOAL8_3\",\"a3\":\"Analisis Performance\",\"b3\":\"Analisis Control\",\"c3\":\"Analisis Eficiency\",\"d3\":\"Analisis Services \",\"soal_kunci_jawaban3\":\"D\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Laporan penjualan yang dihasilkan selalu terlambat dan seringkali datanya tidak akurat, adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar4\":\"SOAL8_4\",\"a4\":\"Analisis Performance\",\"b4\":\"Analisis Control\",\"c4\":\"Analisis Eficiency\",\"d4\":\"Analisis Services\",\"soal_kunci_jawaban4\":\"C\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Memastikan bahwa sistem yang baru akan dapat diimplementaskan dengan menggunakan komputer yang telah dimiliki adalah contoh hasil studi kelayakan untuk aspek :\",\"gambar5\":\"SOAL8_5\",\"a5\":\"Teknis\",\"b5\":\"Operasional\",\"c5\":\"Ekonomi\",\"d5\":\"Hukum\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\",\"soal_pertanyaan6\":\"Memastikan bahwa sistem yang baru akan dapat diterima oleh orang-orang yang ada di dalam organisasi adalah contoh hasil studi kelayakan untuk aspek :\",\"gambar6\":\"SOAL8_6\",\"a6\":\"Teknis\",\"b6\":\"Operasional\",\"c6\":\"Ekonomi\",\"d6\":\"Hukum\",\"soal_kunci_jawaban6\":\"B\",\"soal_input6\":\"text\",\"soal_pertanyaan7\":\"Data dikumpulkan oleh tim pengembang dengan mewawancarai bagian penjualan secara langsung untuk mengetahui kendala yang dihadapi dan kebutuhan akan sistem yang baru. Data yang dikumpulkan tersebut akan dijadikan dasar dalam merancang prosedur sistem baru yang akan dikembangkan. Berdasarkan cara memperolehnya, data yang dikumpulkan tersebut dikategorikan ke dalam jenis data :\",\"gambar7\":\"SOAL8_7\",\"a7\":\"Primer\",\"b7\":\"Sekunder\",\"c7\":\"Eksternal\",\"d7\":\"Time Series\",\"soal_kunci_jawaban7\":\"A\",\"soal_input7\":\"text\",\"soal_pertanyaan8\":\"Data diperoleh tim pengembang dari dokumen-dokumen yang dimiliki oleh klien (pengguna) untuk dijadikan acuan dan dasar dalam kegiatan analisis kebutuhan pengguna. Data tersebut dikategorikan ke dalam jenis data :\",\"gambar8\":\"SOAL8_8\",\"a8\":\"Primer\",\"b8\":\"Sekunder\",\"c8\":\"Eksternal\",\"d8\":\"Time Series\",\"soal_kunci_jawaban8\":\"B\",\"soal_input8\":\"text\",\"soal_pertanyaan9\":\"Ketika melakukan pengumpulan data melalui observasi tim pengembang tidak terlibat langsung dengan kegiatan penjualan yang merupakan objek dari sistem informasi yang akan dikembangkan, melainkan hanya melakukan pengamatan terhadap kegiatan yang dilakukan oleh bagian penjualan pada periode waktu tertentu. Kegiatan yang dilakukan oleh tim pengembang tersebut termasuk jenis observasi dengan menggunakan teknik :\",\"gambar9\":\"SOAL8_9\",\"a9\":\"Participant Observation\",\"b9\":\"Non Participant Observation\",\"c9\":\"Time Series Observation\",\"d9\":\"Sekunder  Observation\",\"soal_kunci_jawaban9\":\"B\",\"soal_input9\":\"text\",\"soal_pertanyaan10\":\"Tim pengembang mengumpulkan data yang dibutuhkan dari Bagian Penjualan dari waktu ke waktu agar data yang diperoleh dapat menggambarkan perkembangan dari kegiatan penjualan. Data yang dikumpulkan oleh tim pengembang tersebut ke dalam jenis data :\",\"gambar10\":\"SOAL8_10\",\"a10\":\"Time Series\",\"b10\":\"Cross Section\",\"c10\":\"Eksternal\",\"d10\":\"Sekunder\",\"soal_kunci_jawaban10\":\"A\",\"soal_input10\":\"text\"}', '4', '9', '2022-05-15', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_post_hasil`
--

CREATE TABLE `t_post_hasil` (
  `post_hasil_id` int(11) NOT NULL,
  `post_hasil_materi` text NOT NULL,
  `post_hasil_siswa` text NOT NULL,
  `post_hasil_soal` text NOT NULL,
  `post_hasil_jawaban` text NOT NULL,
  `post_hasil_nilai_1` text NOT NULL,
  `post_hasil_nilai_2` text NOT NULL,
  `post_hasil_sisa` text NOT NULL,
  `post_hasil_kesempatan` datetime NOT NULL DEFAULT current_timestamp(),
  `post_hasil_tanggal` date DEFAULT curdate(),
  `post_hasil_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_post_hasil`
--

INSERT INTO `t_post_hasil` (`post_hasil_id`, `post_hasil_materi`, `post_hasil_siswa`, `post_hasil_soal`, `post_hasil_jawaban`, `post_hasil_nilai_1`, `post_hasil_nilai_2`, `post_hasil_sisa`, `post_hasil_kesempatan`, `post_hasil_tanggal`, `post_hasil_hapus`) VALUES
(1, '', '46', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"C\"]', '80', '', '19 menit : 39 detik', '2022-05-06 12:35:28', '2022-05-06', 0),
(2, '', '31', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"C\"]', '80', '', '19 menit : 40 detik', '2022-05-06 12:36:32', '2022-05-06', 0),
(3, '', '47', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"D\"]', '80', '', '19 menit : 31 detik', '2022-05-06 12:37:44', '2022-05-06', 0),
(4, '', '48', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"D\"]', '80', '', '19 menit : 40 detik', '2022-05-06 12:38:37', '2022-05-06', 0),
(5, '', '49', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 40 detik', '2022-05-06 12:39:31', '2022-05-06', 0),
(6, '', '50', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 45 detik', '2022-05-06 12:40:21', '2022-05-06', 0),
(7, '', '51', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 45 detik', '2022-05-06 12:41:07', '2022-05-06', 0),
(8, '', '52', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 45 detik', '2022-05-06 12:42:03', '2022-05-06', 0),
(9, '', '53', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 45 detik', '2022-05-06 12:42:48', '2022-05-06', 0),
(10, '', '54', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 44 detik', '2022-05-06 12:43:36', '2022-05-06', 0),
(11, '', '55', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 45 detik', '2022-05-06 12:44:23', '2022-05-06', 0),
(12, '', '56', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 45 detik', '2022-05-06 12:45:07', '2022-05-06', 0),
(13, '', '57', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 46 detik', '2022-05-06 12:45:52', '2022-05-06', 0),
(14, '', '58', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 47 detik', '2022-05-06 12:46:33', '2022-05-06', 0),
(15, '', '59', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"C\"]', '80', '', '19 menit : 47 detik', '2022-05-06 12:47:13', '2022-05-06', 0),
(16, '', '60', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"C\"]', '80', '', '19 menit : 46 detik', '2022-05-06 12:47:55', '2022-05-06', 0),
(17, '', '61', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"C\"]', '80', '', '19 menit : 45 detik', '2022-05-06 12:48:41', '2022-05-06', 0),
(18, '', '62', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 45 detik', '2022-05-06 12:49:27', '2022-05-06', 0),
(19, '', '63', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 38 detik', '2022-05-06 12:50:19', '2022-05-06', 0),
(20, '', '64', 'SOAL2', '[\"A\",\"A\",\"B\",\"A\",\"A\"]', '100', '', '19 menit : 44 detik', '2022-05-06 12:51:03', '2022-05-06', 0),
(21, '', '46', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"C\",\"A\"]', '80', '', '58 menit : 51 detik', '2022-05-16 01:07:27', '2022-05-16', 0),
(22, '', '31', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"A\",\"A\",\"A\",\"A\"]', '80', '', '59 menit : 28 detik', '2022-05-16 01:08:48', '2022-05-16', 0),
(23, '', '47', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"A\"]', '90', '', '59 menit : 22 detik', '2022-05-16 01:10:08', '2022-05-16', 0),
(24, '', '48', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"C\",\"A\"]', '80', '', '59 menit : 30 detik', '2022-05-16 01:11:22', '2022-05-16', 0),
(25, '', '49', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"A\"]', '90', '', '59 menit : 28 detik', '2022-05-16 01:12:36', '2022-05-16', 0),
(26, '', '50', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"A\"]', '90', '', '59 menit : 27 detik', '2022-05-16 01:13:54', '2022-05-16', 0),
(27, '', '51', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"A\"]', '90', '', '59 menit : 34 detik', '2022-05-16 01:15:08', '2022-05-16', 0),
(28, '', '52', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"B\"]', '100', '', '59 menit : 33 detik', '2022-05-16 01:16:17', '2022-05-16', 0),
(29, '', '53', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"B\"]', '100', '', '59 menit : 29 detik', '2022-05-16 01:17:36', '2022-05-16', 0),
(30, '', '54', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"A\"]', '90', '', '59 menit : 28 detik', '2022-05-16 01:18:46', '2022-05-16', 0),
(31, '', '55', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"C\",\"B\"]', '90', '', '59 menit : 27 detik', '2022-05-16 01:20:08', '2022-05-16', 0),
(32, '', '56', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"B\"]', '100', '', '59 menit : 33 detik', '2022-05-16 01:21:16', '2022-05-16', 0),
(33, '', '57', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"C\",\"B\"]', '90', '', '59 menit : 31 detik', '2022-05-16 01:22:29', '2022-05-16', 0),
(34, '', '58', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"C\",\"B\"]', '90', '', '59 menit : 23 detik', '2022-05-16 01:23:55', '2022-05-16', 0),
(35, '', '59', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"C\",\"A\"]', '80', '', '59 menit : 34 detik', '2022-05-16 01:25:01', '2022-05-16', 0),
(36, '', '60', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"C\",\"B\"]', '90', '', '59 menit : 27 detik', '2022-05-16 01:26:08', '2022-05-16', 0),
(37, '', '61', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"A\"]', '90', '', '59 menit : 29 detik', '2022-05-16 01:27:15', '2022-05-16', 0),
(38, '', '62', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"B\"]', '100', '', '59 menit : 30 detik', '2022-05-16 01:28:25', '2022-05-16', 0),
(39, '', '63', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"A\"]', '70', '90', '59 menit : 29 detik', '2022-05-16 01:29:53', '2022-05-16', 0),
(40, '', '64', 'SOAL6', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"C\",\"B\",\"A\",\"A\",\"A\"]', '90', '', '59 menit : 24 detik', '2022-05-16 01:32:45', '2022-05-16', 0),
(41, '', '46', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"A\"]', '80', '80', '59 menit : 35 detik', '2022-05-16 05:01:24', '2022-05-16', 0),
(42, '', '31', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 33 detik', '2022-05-16 05:04:41', '2022-05-16', 0),
(43, '', '47', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"D\",\"D\"]', '90', '', '59 menit : 29 detik', '2022-05-16 05:05:54', '2022-05-16', 0),
(44, '', '48', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"C\",\"D\"]', '70', '90', '59 menit : 30 detik', '2022-05-16 05:07:02', '2022-05-16', 0),
(45, '', '49', 'SOAL7', '[\"C\",\"A\",\"A\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"D\"]', '90', '', '59 menit : 12 detik', '2022-05-16 05:09:32', '2022-05-16', 0),
(46, '', '50', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"D\"]', '100', '', '59 menit : 30 detik', '2022-05-16 05:10:45', '2022-05-16', 0),
(47, '', '51', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"D\"]', '100', '', '59 menit : 32 detik', '2022-05-16 05:11:53', '2022-05-16', 0),
(48, '', '52', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 24 detik', '2022-05-16 05:13:05', '2022-05-16', 0),
(49, '', '53', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"D\"]', '100', '', '59 menit : 16 detik', '2022-05-16 05:14:28', '2022-05-16', 0),
(50, '', '54', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"D\"]', '100', '', '59 menit : 29 detik', '2022-05-16 05:15:41', '2022-05-16', 0),
(51, '', '55', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"D\"]', '100', '', '59 menit : 30 detik', '2022-05-16 05:16:50', '2022-05-16', 0),
(52, '', '56', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"D\"]', '90', '100', '59 menit : 28 detik', '2022-05-16 05:17:53', '2022-05-16', 0),
(53, '', '57', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"A\",\"A\"]', '80', '', '59 menit : 33 detik', '2022-05-16 05:19:45', '2022-05-16', 0),
(54, '', '58', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"A\",\"A\"]', '80', '', '59 menit : 26 detik', '2022-05-16 05:20:54', '2022-05-16', 0),
(55, '', '59', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"A\",\"B\"]', '80', '', '59 menit : 35 detik', '2022-05-16 05:22:11', '2022-05-16', 0),
(56, '', '60', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"A\",\"B\",\"D\"]', '90', '', '59 menit : 29 detik', '2022-05-16 05:23:19', '2022-05-16', 0),
(57, '', '61', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 11 detik', '2022-05-16 05:24:49', '2022-05-16', 0),
(58, '', '62', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 34 detik', '2022-05-16 05:25:52', '2022-05-16', 0),
(59, '', '63', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"D\",\"B\",\"D\"]', '90', '', '59 menit : 23 detik', '2022-05-16 05:27:00', '2022-05-16', 0),
(60, '', '64', 'SOAL7', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"D\",\"B\",\"B\",\"A\"]', '80', '90', '59 menit : 12 detik', '2022-05-16 05:28:05', '2022-05-16', 0),
(61, '', '46', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 27 detik', '2022-05-16 10:45:53', '2022-05-16', 0),
(62, '', '31', 'SOAL8', '[\"A\",\"D\",\"D\",\"D\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 19 detik', '2022-05-16 10:47:23', '2022-05-16', 0),
(63, '', '47', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 31 detik', '2022-05-16 10:48:21', '2022-05-16', 0),
(64, '', '48', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 27 detik', '2022-05-16 10:49:25', '2022-05-16', 0),
(65, '', '49', 'SOAL8', '[\"A\",\"D\",\"C\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 23 detik', '2022-05-16 10:50:30', '2022-05-16', 0),
(66, '', '50', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"B\"]', '90', '', '59 menit : 33 detik', '2022-05-16 10:51:37', '2022-05-16', 0),
(67, '', '51', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 35 detik', '2022-05-16 10:52:33', '2022-05-16', 0),
(68, '', '52', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 35 detik', '2022-05-16 10:53:24', '2022-05-16', 0),
(69, '', '53', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 28 detik', '2022-05-16 10:54:27', '2022-05-16', 0),
(70, '', '54', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 33 detik', '2022-05-16 10:55:26', '2022-05-16', 0),
(71, '', '55', 'SOAL8', '[\"A\",\"D\",\"C\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 30 detik', '2022-05-16 10:56:28', '2022-05-16', 0),
(72, '', '56', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 35 detik', '2022-05-16 10:57:27', '2022-05-16', 0),
(73, '', '57', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 35 detik', '2022-05-16 10:58:20', '2022-05-16', 0),
(74, '', '58', 'SOAL8', '[\"A\",\"D\",\"D\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 17 detik', '2022-05-16 10:59:30', '2022-05-16', 0),
(75, '', '59', 'SOAL8', '[\"A\",\"D\",\"C\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '80', '', '59 menit : 27 detik', '2022-05-16 11:00:49', '2022-05-16', 0),
(76, '', '60', 'SOAL8', '[\"A\",\"D\",\"D\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 20 detik', '2022-05-16 11:01:57', '2022-05-16', 0),
(77, '', '61', 'SOAL8', '[\"A\",\"D\",\"D\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 33 detik', '2022-05-16 11:03:05', '2022-05-16', 0),
(78, '', '62', 'SOAL8', '[\"A\",\"D\",\"C\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '90', '', '59 menit : 26 detik', '2022-05-16 11:04:12', '2022-05-16', 0),
(79, '', '63', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 32 detik', '2022-05-16 11:05:15', '2022-05-16', 0),
(80, '', '64', 'SOAL8', '[\"A\",\"D\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '100', '', '59 menit : 37 detik', '2022-05-16 11:06:09', '2022-05-16', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pre`
--

CREATE TABLE `t_pre` (
  `pre_id` text NOT NULL,
  `pre_judul` text NOT NULL,
  `pre_semester` text NOT NULL,
  `pre_pertemuan` text NOT NULL,
  `pre_pelaksanaan` datetime DEFAULT NULL,
  `pre_durasi` text NOT NULL,
  `pre_petunjuk` text NOT NULL,
  `pre_jumlah` text NOT NULL,
  `pre_pertanyaan` text NOT NULL,
  `pre_pelajaran` text NOT NULL,
  `pre_kelas` text NOT NULL,
  `pre_tanggal` date DEFAULT NULL,
  `pre_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_pre`
--

INSERT INTO `t_pre` (`pre_id`, `pre_judul`, `pre_semester`, `pre_pertemuan`, `pre_pelaksanaan`, `pre_durasi`, `pre_petunjuk`, `pre_jumlah`, `pre_pertanyaan`, `pre_pelajaran`, `pre_kelas`, `pre_tanggal`, `pre_hapus`) VALUES
('SOAL2', 'KB 1-1. Konsep Dasar SI', '4', '1', '2022-04-16 06:06:00', '10', 'Pilihlah jawaban yang paling benar', '2', '{\"pre_judul\":\"KB 1-1. Konsep Dasar SI\",\"pre_pelajaran\":\"4\",\"pre_kelas\":[\"9\"],\"pre_pelaksanaan\":\"2022-04-16T06:06:00\",\"pre_durasi\":\"10\",\"pre_petunjuk\":\"Pilihlah jawaban yang paling benar\",\"pre_id\":\"SOAL2\",\"pre_jumlah\":\"2\",\"soal_pertanyaan1\":\"Pernyataan berikut ini yang paling benar, adalah : \",\"gambar1\":\"SOAL2_1\",\"a1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa spesifikasi.\",\"b1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa perangkat keras dan batasan berupa spesifikasi.\",\"c1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa perangkat lunak.\",\"d1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa perangkat lunak dan batasan berupa spesifikasi.\",\"soal_kunci_jawaban1\":\"A\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Komputer adalah sebuah sistem. Komputer dapat dikategorikan ke dalam beberapa kelompok berikut :\",\"gambar2\":\"SOAL2_2\",\"a2\":\"Fisik, Buatan Manusia, Deterministik, Tertutup.\",\"b2\":\"Fisik, Buatan Manusia, Probabilistik, Tertutup.\",\"c2\":\"Fisik, Buatan Manusia, Deterministik, Terbuka.\",\"d2\":\"Fisik, Buatan Manusia, Probabilistik, Terbuka.\",\"soal_kunci_jawaban2\":\"C\",\"soal_input2\":\"text\"}', '4', '9', '2022-04-16', 1),
('SOAL3', 'KB 1-1. Konsep Dasar SI', '4', '1', '2022-05-06 18:30:00', '30', 'Silakan pilih satu jawaban yang paling tepat.', '5', '{\"pre_judul\":\"KB 1-1. Konsep Dasar SI\",\"pre_pelajaran\":\"4\",\"pre_kelas\":[\"9\"],\"pre_pelaksanaan\":\"2022-05-06T18:30:00\",\"pre_durasi\":\"30\",\"pre_petunjuk\":\"Silakan pilih satu jawaban yang paling tepat.\",\"pre_id\":\"SOAL3\",\"pre_jumlah\":\"5\",\"soal_pertanyaan1\":\"Pernyataan berikut ini yang paling benar, adalah : \",\"gambar1\":\"SOAL3_1\",\"a1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa spesifikasi.\",\"b1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa perangkat keras dan batasan berupa spesifikasi.\",\"c1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa perangkat lunak.\",\"d1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa perangkat lunak dan batasan berupa spesifikasi.\",\"soal_kunci_jawaban1\":\"A\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Surat Keterangan Aktif Kuliah, adalah sebuah surat keterangan yang berisikan status keaktifan mahasiswa pada tahun akademik berjalan. Surat Keterangan Aktif Kuliah dapat dikategorikan ke dalam suatu informasi karena memenuhi beberapa karakteristik, yaitu :\",\"gambar2\":\"SOAL3_2\",\"a2\":\"Benar, Baru, Penegas\",\"b2\":\"Benar, Baru, Tambahan\",\"c2\":\"Benar, Baru, Korektif\",\"d2\":\"Benar, Baru.\",\"soal_kunci_jawaban2\":\"A\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Toko Untung Selalu adalah toko yang menjual alat tulis kantor. Pemilik toko bermaksud untuk membangun aplikasi penjualan online agar dapat memperluas area pemasaran produk yang dijual mengingat selama ini pembeli terbatas dari wilayah sekitar toko saja. Hal ini sesuai dengan alasan perlunya pengembangan sistem, yaitu :\",\"gambar3\":\"SOAL3_3\",\"a3\":\"Adanya masalah pada sistem yang lama\",\"b3\":\"Untuk meraih kesempatan \",\"c3\":\"Adanya instruksi\",\"d3\":\"Pertumbuhan organisasi\",\"soal_kunci_jawaban3\":\"B\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Analis sistem mempelajari prosedur sistem penjualan yang ada pada toko Untung Selalu untuk mengetahui permasalahan yang ada dan mewawancarai pemilik toko untuk mengetahui keinginan\\/kebutuhannya agar dapat memberikan saran perbaikan atau pengembangan yang dapat dilakukan. Kegiatan ini dilakukan pada tahap :\",\"gambar4\":\"SOAL3_4\",\"a4\":\"Analisis Sistem \",\"b4\":\"Desain Sistem\",\"c4\":\"Implementasi Sistem\",\"d4\":\"Pemeliharaan Sistem\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Jika dipandang dari cara mengembangkannya, maka metode pendekatan pengembangan sistem yang paling cocok digunakan dalam melakukan pengembangan sistem penjualan online pada sebuah toko kecil, adalah :\",\"gambar5\":\"SOAL3_5\",\"a5\":\"Pendekatan Menyeluruh \",\"b5\":\"Pendekatan Lompat Jauh\",\"c5\":\"Pendekatan Sistem\",\"d5\":\"Pendekatan Berkembang\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\"}', '4', '9', '2022-05-05', 1),
('SOAL4', 'KB 1-2. Metodologi Pengembangan SI', '4', '2', '2022-05-07 09:35:00', '10', 'Silakan pilih satu jawaban yang paling tepat.', '5', '{\"pre_judul\":\"KB 1-2. Metodologi Pengembangan SI\",\"pre_pelajaran\":\"4\",\"pre_kelas\":[\"9\"],\"pre_pelaksanaan\":\"2022-05-07T09:35\",\"pre_durasi\":\"10\",\"pre_petunjuk\":\"Silakan pilih satu jawaban yang paling tepat.\",\"pre_id\":\"SOAL4\",\"pre_jumlah\":\"5\",\"soal_pertanyaan1\":\"Pengembangan sistem Toko Online Untung Selalu sudah jelas kebutuhannya sejak awal karena pemilik toko telah dapat mendeskripsikan kebutuhannya dengan sangat jelas. Proyek pengembangan ini merupakan proyek berskala kecil sehingga tidak melibatkan personil tim dalam jumlah yang banyak. Berdasarkan hal tersebut maka metode pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar1\":\"SOAL4_1\",\"a1\":\"Prototyping\",\"b1\":\"Agile\",\"c1\":\"Systems Development Life Cycle (SDLC) \",\"d1\":\"Rapid Aplication Development (RAD)\",\"soal_kunci_jawaban1\":\"C\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Tim pengembang mendapatkan pesanan untuk melakukan pengembangan sistem informasi untuk sistem yang kompleks sehingga membutuhkan anggota tim pengembang yang sudah berpengalaman dan berkomitmen. Berdasarkan hal tersebut maka metodologi pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar2\":\"SOAL4_2\",\"a2\":\"Object Oriented Analysis and Design (OOAD).\",\"b2\":\"Prototyping\",\"c2\":\"Scrum\",\"d2\":\"Agile\",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Tim pengembang melibatkan klien (pengguna sistem) untuk mengomentari setiap versi sistem informasi yang dikembangkan sampai dihasilkannya versi yang memenuhi kriteria, hal ini akan berdampak pada :\",\"gambar3\":\"SOAL4_3\",\"a3\":\"Ketepatan waktu penyelesaian proyek pengembangan sistem lebih terjamin\",\"b3\":\"Biaya pengembangan sistem menjadi lebih besar\",\"c3\":\"Jadwal kerja menjadi tidak menentu.\",\"d3\":\"Kebutuhan jumlah anggota tim pengembang menjadi lebih banyak.\",\"soal_kunci_jawaban3\":\"A\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Menggunakan sistem informasi yang telah ada untuk dikembangkan menjadi sistem informasi yang baru dapat dilakukan untuk sistem dengan proses bisnis yang hampir sama sehingga akan berdampak pada :\",\"gambar4\":\"SOAL4_4\",\"a4\":\"Waktu penyelesaian proyek lebih cepat\",\"b4\":\"Biaya pengembangan sistem yang lebih besar\",\"c4\":\"Jumlah anggota tim pengembang yang lebih banyak\",\"d4\":\"Jadwal kerja menjadi tidak menentu\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Metodologi pengembangan sistem informasi yang paling tepat digunakan untuk menangani masalah yang kompleks karena dapat mentransformasukan bisnis yang sulit diukur menjadi lebih mudah dikembangkan adalah :\",\"gambar5\":\"SOAL4_5\",\"a5\":\"Object Oriented Analysis and Design (OOAD). \",\"b5\":\"Prototyping\",\"c5\":\"Scrum\",\"d5\":\"Agile\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\"}', '4', '9', '2022-05-05', 1),
('SOAL5', 'KB 2-1. Menganalisis Sistem', '4', '3', '2022-05-08 09:00:00', '10', 'Silahkan pilih satu jawaban yang paling tepat', '5', '{\"pre_semester\":\"4\",\"pre_pertemuan\":\"3\",\"pre_judul\":\"KB 2-1. Menganalisis Sistem\",\"pre_pelajaran\":\"4\",\"pre_kelas\":[\"9\"],\"pre_pelaksanaan\":\"2022-05-08T09:00\",\"pre_durasi\":\"10\",\"pre_petunjuk\":\"Silahkan pilih satu jawaban yang paling tepat\",\"pre_id\":\"SOAL5\",\"pre_jumlah\":\"5\",\"soal_pertanyaan1\":\"Staf administrasi menginput data yang sama berulang kali adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar1\":\"SOAL5_1\",\"a1\":\"Analisis Performance\",\"b1\":\"Analisis Control\",\"c1\":\"Analisis Eficiency\",\"d1\":\"Analisis Services \",\"soal_kunci_jawaban1\":\"D\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Sistem informasi tidak mudah digunakan dan sulit dipelajari adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar2\":\"SOAL5_2\",\"a2\":\"Analisis Performance\",\"b2\":\"Analisis Control\",\"c2\":\"Analisis Eficiency\",\"d2\":\"Analisis Services \",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Laporan penjualan yang dihasilkan selalu terlambat dan seringkali datanya tidak akurat, adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar3\":\"SOAL5_3\",\"a3\":\"Analisis Performance\",\"b3\":\"Analisis Control\",\"c3\":\"Analisis Eficiency\",\"d3\":\"Analisis Services \",\"soal_kunci_jawaban3\":\"C\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Memastikan bahwa sistem yang baru akan dapat diterima oleh orang-orang yang ada di dalam organisasi adalah contoh hasil studi kelayakan untuk aspek :\",\"gambar4\":\"SOAL5_4\",\"a4\":\"Teknis\",\"b4\":\"Operasional\",\"c4\":\"Ekonomi\",\"d4\":\"Hukum\",\"soal_kunci_jawaban4\":\"B\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Tim pengembang mengumpulkan data yang dibutuhkan dari Bagian Penjualan dari waktu ke waktu agar data yang diperoleh dapat menggambarkan perkembangan dari kegiatan penjualan. Data yang dikumpulkan oleh tim pengembang tersebut ke dalam jenis data :\",\"gambar5\":\"SOAL5_5\",\"a5\":\"Time series \",\"b5\":\"Cross section \",\"c5\":\"Eksternal\",\"d5\":\"Sekunder\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\"}', '4', '9', '2022-05-05', 1),
('SOAL6', 'KB 2-2. Merancang Pemodelan Sistem Dengan Flow of Document', '4', '4', '2022-05-05 19:30:00', '10', 'Silahkan pilih satu jawaban yang paling tepat', '5', '{\"pre_judul\":\"KB 2-2. Merancang Pemodelan Sistem Dengan Flow of Document\",\"pre_pelajaran\":\"4\",\"pre_kelas\":[\"9\"],\"pre_pelaksanaan\":\"2022-05-05T19:30:00\",\"pre_durasi\":\"10\",\"pre_petunjuk\":\"Silahkan pilih satu jawaban yang paling tepat\",\"pre_id\":\"SOAL6\",\"pre_jumlah\":\"5\",\"soal_pertanyaan1\":\"Simbol yang tepat untuk huruf b adalah :\",\"gambar1\":\"SOAL6_1\",\"soal_kunci_jawaban1\":\"D\",\"soal_input1\":\"image\",\"soal_pertanyaan2\":\"Simbol yang tepat untuk huruf d adalah :\",\"gambar2\":\"SOAL6_2\",\"soal_kunci_jawaban2\":\"A\",\"soal_input2\":\"image\",\"soal_pertanyaan3\":\"Huruf a, b dan c pada gambar Flow of Document di atas adalah pihak-pihak yang terlibat langsung dengan sistem, sebagai berikut :\",\"gambar3\":\"SOAL6_3\",\"a3\":\"a=Pelanggan   b=Kasir    c=Pemilik Toko \",\"b3\":\"a=Bagian Penjualan   b=Kasir    c=Pemilik Toko\",\"c3\":\"a=Kasir   b=Pelanggan    c=Pemilik Toko\",\"d3\":\"a=Pelanggan   b=Pemilik Toko   c=Bagian Penjualan\",\"soal_kunci_jawaban3\":\"A\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Simbol yang tepat untuk huruf g adalah :\",\"gambar4\":\"SOAL6_4\",\"soal_kunci_jawaban4\":\"B\",\"soal_input4\":\"image\",\"soal_pertanyaan5\":\"Nama yang tepat untuk simbol dengan huruf f adalah :\",\"gambar5\":\"SOAL6_5\",\"a5\":\"Slip Penjualan \",\"b5\":\"Membuat Slip Penjualan\",\"c5\":\"Mencetak Slip Penjualan\",\"d5\":\"Memberi stempel pada Slip Penjualan\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\"}', '4', '9', '2022-05-05', 1),
('SOAL7', 'KB 1-1. Konsep Dasar SI', '4', '1', '2022-05-16 08:15:00', '30', 'Silakan pilih satu jawaban yang paling tepat.', '10', '{\"pre_judul\":\"KB 1-1. Konsep Dasar SI\",\"pre_pelajaran\":\"4\",\"pre_kelas\":[\"9\"],\"pre_pelaksanaan\":\"2022-05-16T08:15\",\"pre_durasi\":\"30\",\"pre_petunjuk\":\"Silakan pilih satu jawaban yang paling tepat.\",\"pre_id\":\"SOAL7\",\"pre_jumlah\":\"10\",\"soal_pertanyaan1\":\"Pernyataan yang paling benar, adalah : \",\"gambar1\":\"SOAL7_1\",\"a1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa spesifikasi\",\"b1\":\"Super sistem dari komputer adalah teknologi, yang memiliki lingkungan luar berupa perangkat keras dan batasan berupa spesifikasi.\",\"c1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa aliran listrik dan batasan berupa perangkat lunak.\",\"d1\":\"Super sistem dari komputer adalah perangkat keras, yang memiliki lingkungan luar berupa perangkat lunak dan batasan berupa spesifikasi.\",\"soal_kunci_jawaban1\":\"A\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Komputer adalah sebuah sistem. Komputer dapat dikategorikan ke dalam beberapa kelompok berikut :\",\"gambar2\":\"SOAL7_2\",\"a2\":\"Fisik, Buatan Manusia, Deterministik, Tertutup.\",\"b2\":\"Fisik, Buatan Manusia, Probabilistik, Tertutup.\",\"c2\":\"Fisik, Buatan Manusia, Deterministik, Terbuka.\",\"d2\":\"Fisik, Buatan Manusia, Probabilistik, Terbuka.\",\"soal_kunci_jawaban2\":\"C\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Perbedaan yang mendasar antara sistem dengan sistem informasi terletak pada komponen :\",\"gambar3\":\"SOAL7_3\",\"a3\":\"Manusia\",\"b3\":\"Alat\",\"c3\":\"Konsep\",\"d3\":\"Prosedur\",\"soal_kunci_jawaban3\":\"B\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Surat Keterangan Aktif Kuliah, adalah sebuah surat keterangan yang berisikan status keaktifan mahasiswa pada tahun akademik berjalan. Surat Keterangan Aktif Kuliah dapat dikategorikan ke dalam suatu informasi karena memenuhi beberapa karakteristik, yaitu :\",\"gambar4\":\"SOAL7_4\",\"a4\":\"Benar, Baru, Penegas\",\"b4\":\"Benar, Baru, Tambahan\",\"c4\":\"Benar, Baru, Korektif.\",\"d4\":\"Benar, Baru.\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Jadwal kuliah diposting pada SIAKAD sejak seminggu sebelum kegiatan perkuliahan di awal semester dimulai, yang dapat diakses oleh mahasiswa di beranda masing-masing. Ini merupakan contoh informasi yang berkualitas karena memenuhi unsur-unsur  :\",\"gambar5\":\"SOAL7_5\",\"a5\":\"Akurat, Relevan\",\"b5\":\"Akurat, Relevan, Tepat Waktu\",\"c5\":\"Akurat, Tepat Waktu, Bernilai\",\"d5\":\"Relevan, Tepat Waktu\",\"soal_kunci_jawaban5\":\"B\",\"soal_input5\":\"text\",\"soal_pertanyaan6\":\"Web Developer bekerja membangun aplikasi sesuai dengan rancangan sistem yang dibuat oleh Analis Sistem. Kegiatan ini dilakukan pada tahap :\",\"gambar6\":\"SOAL7_6\",\"a6\":\"Analisis Sistem\",\"b6\":\"Desain Sistem.\",\"c6\":\"Implementasi Sistem\",\"d6\":\"Pemeliharaan Sistem\",\"soal_kunci_jawaban6\":\"C\",\"soal_input6\":\"text\",\"soal_pertanyaan7\":\"Toko Untung Selalu adalah toko yang menjual alat tulis kantor. Pemilik toko bermaksud untuk membangun aplikasi penjualan online agar dapat memperluas area pemasaran produk yang dijual mengingat selama ini pembeli terbatas dari wilayah sekitar toko saja. Hal ini sesuai dengan alasan perlunya pengembangan sistem, yaitu :\",\"gambar7\":\"SOAL7_7\",\"a7\":\"Adanya masalah pada sistem yang lama\",\"b7\":\"Untuk meraih kesempatan \",\"c7\":\"Adanya instruksi\",\"d7\":\"Pertumbuhan organisasi\",\"soal_kunci_jawaban7\":\"B\",\"soal_input7\":\"text\",\"soal_pertanyaan8\":\"Analis sistem mempelajari prosedur sistem penjualan yang ada pada toko Untung Selalu untuk mengetahui permasalahan yang ada dan mewawancarai pemilik toko untuk mengetahui keinginan\\/kebutuhannya agar dapat memberikan saran perbaikan atau pengembangan yang dapat dilakukan. Kegiatan ini dilakukan pada tahap :\",\"gambar8\":\"SOAL7_8\",\"a8\":\"Analisis Sistem \",\"b8\":\"Desain Sistem\",\"c8\":\"Implementasi Sistem\",\"d8\":\"Pemeliharaan Sistem\",\"soal_kunci_jawaban8\":\"A\",\"soal_input8\":\"text\",\"soal_pertanyaan9\":\"Jika dipandang dari cara mengembangkannya, maka metode pendekatan pengembangan sistem yang paling cocok digunakan dalam melakukan pengembangan sistem penjualan online pada  Toko Untung Selalu, adalah :\",\"gambar9\":\"SOAL7_9\",\"a9\":\"Pendekatan Menyeluruh \",\"b9\":\"Pendekatan Lompat Jauh\",\"c9\":\"Pendekatan Sistem\",\"d9\":\"Pendekatan Berkembang\",\"soal_kunci_jawaban9\":\"A\",\"soal_input9\":\"text\",\"soal_pertanyaan10\":\"Mengikuti tahapan di dalam siklus hidup sistem tanpa dibekali dengan alat-alat dan teknik-teknik yang memadai, sehingga pengembangan sistem informasi menjadi sulit dan  keberhasilan sistem kurang terjamin, merupakan ciri-ciri dari pendekatan pengembangan sistem dengan metode :\",\"gambar10\":\"SOAL7_10\",\"a10\":\"Pendekatan Terstruktur\",\"b10\":\"Pendekatan Klasik \",\"c10\":\"Pendekatan Lompat Jauh\",\"d10\":\"Pendekatan Berkembang\",\"soal_kunci_jawaban10\":\"B\",\"soal_input10\":\"text\"}', '4', '9', '2022-05-15', 0),
('SOAL8', 'KB 1-2. Metodologi Pengembangan SI', '4', '1', '2022-05-16 09:45:00', '60', 'Silakan pilih satu jawaban yang paling tepat.', '10', '{\"pre_judul\":\"KB 1-2. Metodologi Pengembangan SI\",\"pre_pelajaran\":\"4\",\"pre_kelas\":[\"9\"],\"pre_pelaksanaan\":\"2022-05-16T09:45\",\"pre_durasi\":\"60\",\"pre_petunjuk\":\"Silakan pilih satu jawaban yang paling tepat.\",\"pre_id\":\"SOAL8\",\"pre_jumlah\":\"10\",\"soal_pertanyaan1\":\"Pengembangan sistem Toko Online Untung Selalu sudah jelas kebutuhannya sejak awal karena pemilik toko telah dapat mendeskripsikan kebutuhannya dengan sangat jelas. Proyek pengembangan ini merupakan proyek berskala kecil sehingga tidak melibatkan personil tim dalam jumlah yang banyak. Berdasarkan hal tersebut maka metode pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar1\":\"SOAL8_1\",\"a1\":\"Prototyping \",\"b1\":\"Agile\",\"c1\":\"Systems Development Life Cycle (SDLC) \",\"d1\":\"Rapid Aplication Development (RAD)\",\"soal_kunci_jawaban1\":\"C\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Seringkali proses bisnis pengguna sistem yang satu dengan yang lain hampir sama sehingga tim pengembang dapat menggunakan sistem informasi yang telah ada untuk dikembangkan menjadi sistem informasi yang baru. Berdasarkan hal tersebut maka metode pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar2\":\"SOAL8_2\",\"a2\":\"Metodologi Pengembangan Berorientasi Pemakaian Ulang (Re-Usable) \",\"b2\":\"Systems Development Life Cycle (SDLC)\",\"c2\":\"Rapid Aplication Development (RAD)\",\"d2\":\"Spiral\",\"soal_kunci_jawaban2\":\"A\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Tim pengembang mendapatkan pesanan untuk melakukan pengembangan sistem informasi untuk sistem yang kompleks sehingga membutuhkan anggota tim pengembang yang sudah berpengalaman dan berkomitmen. Berdasarkan hal tersebut maka metodologi pengembangan sistem yang paling cocok digunakan adalah :\",\"gambar3\":\"SOAL8_3\",\"a3\":\"Object Oriented Analysis and Design (OOAD).\",\"b3\":\"Prototyping.\",\"c3\":\"Scrum.\",\"d3\":\"Agile\",\"soal_kunci_jawaban3\":\"D\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Tim pengembang melibatkan klien (pengguna sistem) untuk mengomentari setiap versi sistem informasi yang dikembangkan sampai dihasilkannya versi yang memenuhi kriteria, hal ini akan berdampak pada :\",\"gambar4\":\"SOAL8_4\",\"a4\":\"Ketepatan waktu penyelesaian proyek pengembangan sistem lebih terjamin\",\"b4\":\"Biaya pengembangan sistem menjadi lebih besar\",\"c4\":\"Jadwal kerja menjadi tidak menentu.\",\"d4\":\"Kebutuhan jumlah anggota tim pengembang menjadi lebih banyak.\",\"soal_kunci_jawaban4\":\"A\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Menggunakan sistem informasi yang telah ada untuk dikembangkan menjadi sistem informasi yang baru dapat dilakukan untuk sistem dengan proses bisnis yang hampir sama sehingga akan berdampak pada :\",\"gambar5\":\"SOAL8_5\",\"a5\":\"Waktu penyelesaian proyek lebih cepat\",\"b5\":\"Biaya pengembangan sistem yang lebih besar.\",\"c5\":\"Jumlah anggota tim pengembang yang lebih banyak\",\"d5\":\"Jadwal kerja menjadi tidak menentu.\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\",\"soal_pertanyaan6\":\"Metodologi pengembangan sistem informasi yang paling tepat digunakan untuk menangani masalah yang kompleks karena dapat mentransformasukan bisnis yang sulit diukur menjadi lebih mudah dikembangkan adalah :\",\"gambar6\":\"SOAL8_6\",\"a6\":\"Object Oriented Analysis and Design (OOAD) \",\"b6\":\"Prototyping\",\"c6\":\"Scrum\",\"d6\":\"Agile\",\"soal_kunci_jawaban6\":\"A\",\"soal_input6\":\"text\",\"soal_pertanyaan7\":\"Metodologi pengembangan sistem informasi yang menekankan pada sistem yang mudah dalam menerima perubahan dan mampu beradaptasi dengan cepat, sehingga memungkinkan proyek dapat selesai dengan cepat adalah :\",\"gambar7\":\"SOAL8_7\",\"a7\":\"Rapid Aplication Development (RAD)\",\"b7\":\"Prototyping\",\"c7\":\"Scrum\",\"d7\":\"Agile\",\"soal_kunci_jawaban7\":\"D\",\"soal_input7\":\"text\",\"soal_pertanyaan8\":\"Metodologi pengembangan sistem informasi yang dapat digunakan untuk kebutuhan sistem informasi pengguna (klien) yang berubah sewaktu-waktu adalah : \",\"gambar8\":\"SOAL8_8\",\"a8\":\"Scrum\",\"b8\":\"Spiral\",\"c8\":\"Agile\",\"d8\":\"Rapid Aplication Development (RAD)\",\"soal_kunci_jawaban8\":\"B\",\"soal_input8\":\"text\",\"soal_pertanyaan9\":\"Metodologi pengembangan sistem informasi yang kurang fleksibel terhadap perubahan dikarenakan proses perancangan yang terlalu singkat, adalah :\",\"gambar9\":\"SOAL8_9\",\"a9\":\"Scrum\",\"b9\":\"Prototyping\",\"c9\":\"Agile\",\"d9\":\"Spiral\",\"soal_kunci_jawaban9\":\"B\",\"soal_input9\":\"text\",\"soal_pertanyaan10\":\"Tidak adanya pemisah antara fase analisis dan disain sehingga akan meningkatkan komunikasi antara pengembang dengan klien dari tahap awal sampai akhir adalah kelebihan dari metode pengembangan sistem informasi :\",\"gambar10\":\"SOAL8_10\",\"a10\":\"Rapid Aplication Development (RAD)\",\"b10\":\"Prototyping\",\"c10\":\"Scrum\",\"d10\":\"Object Oriented Analysis and Design (OOAD) \",\"soal_kunci_jawaban10\":\"D\",\"soal_input10\":\"text\"}', '4', '9', '2022-05-15', 0),
('SOAL9', 'KB 2-1. Menganalisis Sistem', '4', '3', '2022-05-16 13:50:00', '60', 'Pilihlah satu jawaban yang paling tepat', '10', '{\"pre_judul\":\"KB 2-1. Menganalisis Sistem\",\"pre_pelajaran\":\"4\",\"pre_kelas\":[\"9\"],\"pre_pelaksanaan\":\"2022-05-16T13:50\",\"pre_durasi\":\"60\",\"pre_petunjuk\":\"Pilihlah satu jawaban yang paling tepat\",\"pre_id\":\"SOAL9\",\"pre_jumlah\":\"10\",\"soal_pertanyaan1\":\"Kegiatan analisis dilakukan pada bagian penjualan untuk mengetahui jumlah pekerjaan yang bisa diselesaikan selama jangka waktu tertentu dan waktu tanggap yang diberikan pada setiap keterlambatan suatu transaksi yang terjadi. \\r\\nTujuan dari kegiatan ini adalah :\\r\\n\",\"gambar1\":\"SOAL9_1\",\"a1\":\"Mengetahui permasalahan dari aspek performance \",\"b1\":\"Mengetahui permasalahan dari aspek control\",\"c1\":\"Mengetahui permasalahan dari aspek eficiency\",\"d1\":\"Mengetahui permasalahan dari aspek services\",\"soal_kunci_jawaban1\":\"A\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Staf administrasi menginput data yang sama berulang kali adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar2\":\"SOAL9_2\",\"a2\":\"Analisis Performance\",\"b2\":\"Analisis Control\",\"c2\":\"Analisis Eficiency\",\"d2\":\"Analisis Services\",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"text\",\"soal_pertanyaan3\":\"Sistem informasi tidak mudah digunakan dan sulit dipelajari adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar3\":\"SOAL9_3\",\"a3\":\"Analisis Performance\",\"b3\":\"Analisis Control\",\"c3\":\"Analisis Eficiency\",\"d3\":\"Analisis Services\",\"soal_kunci_jawaban3\":\"D\",\"soal_input3\":\"text\",\"soal_pertanyaan4\":\"Laporan penjualan yang dihasilkan selalu terlambat dan seringkali datanya tidak akurat, adalah permasalahan yang ditemukan pada kegiatan :\",\"gambar4\":\"SOAL9_4\",\"a4\":\"Analisis Performance\",\"b4\":\"Analisis Control\",\"c4\":\"Analisis Eficiency\",\"d4\":\"Analisis Services\",\"soal_kunci_jawaban4\":\"C\",\"soal_input4\":\"text\",\"soal_pertanyaan5\":\"Memastikan bahwa sistem yang baru akan dapat diimplementaskan dengan menggunakan komputer yang telah dimiliki adalah contoh hasil studi kelayakan untuk aspek :\",\"gambar5\":\"SOAL9_5\",\"a5\":\"Teknis\",\"b5\":\"Operasional\",\"c5\":\"Ekonomi\",\"d5\":\"Hukum\",\"soal_kunci_jawaban5\":\"A\",\"soal_input5\":\"text\",\"soal_pertanyaan6\":\"Memastikan bahwa sistem yang baru akan dapat diterima oleh orang-orang yang ada di dalam organisasi adalah contoh hasil studi kelayakan untuk aspek :\",\"gambar6\":\"SOAL9_6\",\"a6\":\"Teknis\",\"b6\":\"Operasional\",\"c6\":\"Ekonomi\",\"d6\":\"Hukum\",\"soal_kunci_jawaban6\":\"B\",\"soal_input6\":\"text\",\"soal_pertanyaan7\":\"Data dikumpulkan oleh tim pengembang dengan mewawancarai bagian penjualan secara langsung untuk mengetahui kendala yang dihadapi dan kebutuhan akan sistem yang baru. Data yang dikumpulkan tersebut akan dijadikan dasar dalam merancang prosedur sistem baru yang akan dikembangkan. Berdasarkan cara memperolehnya, data yang dikumpulkan tersebut dikategorikan ke dalam jenis data :\",\"gambar7\":\"SOAL9_7\",\"a7\":\"Primer\",\"b7\":\"Sekunder\",\"c7\":\"Eksternal\",\"d7\":\"Time Series\",\"soal_kunci_jawaban7\":\"A\",\"soal_input7\":\"text\",\"soal_pertanyaan8\":\"Data diperoleh tim pengembang dari dokumen-dokumen yang dimiliki oleh klien (pengguna) untuk dijadikan acuan dan dasar dalam kegiatan analisis kebutuhan pengguna. Data tersebut dikategorikan ke dalam jenis data :\",\"gambar8\":\"SOAL9_8\",\"a8\":\"Primer\",\"b8\":\"Sekunder\",\"c8\":\"Eksternal\",\"d8\":\"Time Series\",\"soal_kunci_jawaban8\":\"B\",\"soal_input8\":\"text\",\"soal_pertanyaan9\":\"Ketika melakukan pengumpulan data melalui observasi tim pengembang tidak terlibat langsung dengan kegiatan penjualan yang merupakan objek dari sistem informasi yang akan dikembangkan, melainkan hanya melakukan pengamatan terhadap kegiatan yang dilakukan oleh bagian penjualan pada periode waktu tertentu. Kegiatan yang dilakukan oleh tim pengembang tersebut termasuk jenis observasi dengan menggunakan teknik :\",\"gambar9\":\"SOAL9_9\",\"a9\":\"Participant Observation\",\"b9\":\"Non Participant Observation\",\"c9\":\"Time Series Observation\",\"d9\":\"Sekunder  Observation\",\"soal_kunci_jawaban9\":\"B\",\"soal_input9\":\"text\",\"soal_pertanyaan10\":\"Tim pengembang mengumpulkan data yang dibutuhkan dari Bagian Penjualan dari waktu ke waktu agar data yang diperoleh dapat menggambarkan perkembangan dari kegiatan penjualan. Data yang dikumpulkan oleh tim pengembang tersebut ke dalam jenis data :\",\"gambar10\":\"SOAL9_10\",\"a10\":\"Time Series\",\"b10\":\"Cross Section\",\"c10\":\"Eksternal\",\"d10\":\"Sekunder\",\"soal_kunci_jawaban10\":\"A\",\"soal_input10\":\"text\"}', '4', '9', '2022-05-15', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pre_hasil`
--

CREATE TABLE `t_pre_hasil` (
  `pre_hasil_id` int(11) NOT NULL,
  `pre_hasil_siswa` text NOT NULL,
  `pre_hasil_soal` text NOT NULL,
  `pre_hasil_jawaban` text NOT NULL,
  `pre_hasil_nilai` text NOT NULL,
  `pre_hasil_sisa` text NOT NULL,
  `pre_hasil_tanggal` date DEFAULT curdate(),
  `pre_hasil_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_pre_hasil`
--

INSERT INTO `t_pre_hasil` (`pre_hasil_id`, `pre_hasil_siswa`, `pre_hasil_soal`, `pre_hasil_jawaban`, `pre_hasil_nilai`, `pre_hasil_sisa`, `pre_hasil_tanggal`, `pre_hasil_hapus`) VALUES
(1, '29', 'SOAL2', '[\"A\",\"A\"]', '50', '9 menit : 21 detik', '2022-04-16', 0),
(2, '34', 'SOAL2', '[\"D\",\"D\"]', '0', '9 menit : 30 detik', '2022-04-18', 0),
(3, '33', 'SOAL2', '[\"A\",\"B\"]', '50', '9 menit : 26 detik', '2022-04-18', 0),
(4, '35', 'SOAL2', '[\"B\",\"C\"]', '50', '8 menit : 17 detik', '2022-04-18', 0),
(5, '41', 'SOAL2', '[\"B\",\"B\"]', '0', '9 menit : 48 detik', '2022-04-25', 0),
(6, '37', 'SOAL2', '[\"B\",\"B\"]', '0', '9 menit : 12 detik', '2022-04-25', 0),
(7, '44', 'SOAL2', '[\"C\",\"A\"]', '0', '9 menit : 27 detik', '2022-04-25', 0),
(8, '42', 'SOAL2', '[\"C\",\"B\"]', '0', '9 menit : 2 detik', '2022-04-25', 0),
(9, '43', 'SOAL2', '[\"C\",\"D\"]', '0', '9 menit : 54 detik', '2022-04-25', 0),
(10, '38', 'SOAL2', '[\"C\",\"C\"]', '50', '8 menit : 57 detik', '2022-04-25', 0),
(11, '43', 'SOAL3', '[\"A\",\"D\",\"B\",\"A\",\"A\"]', '20', '9 menit : 45 detik', '2022-04-25', 0),
(12, '40', 'SOAL2', '[\"A\",\"C\"]', '100', '8 menit : 53 detik', '2022-04-25', 0),
(13, '45', 'SOAL2', '[\"A\",\"C\"]', '100', '9 menit : 46 detik', '2022-04-25', 0),
(14, '36', 'SOAL2', '[\"D\",\"B\"]', '0', '8 menit : 47 detik', '2022-04-25', 0),
(15, '39', 'SOAL2', '[\"A\",\"C\"]', '100', '9 menit : 49 detik', '2022-04-25', 0),
(16, '46', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"C\"]', '60', '29 menit : 3 detik', '2022-05-06', 0),
(17, '31', 'SOAL3', '[\"A\",\"A\",\"D\",\"B\",\"C\"]', '40', '29 menit : 34 detik', '2022-05-06', 0),
(18, '47', 'SOAL3', '[\"C\",\"A\",\"B\",\"A\",\"D\"]', '60', '29 menit : 37 detik', '2022-05-06', 0),
(19, '48', 'SOAL3', '[\"D\",\"B\",\"B\",\"A\",\"A\"]', '60', '29 menit : 29 detik', '2022-05-06', 0),
(20, '49', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"A\"]', '80', '29 menit : 40 detik', '2022-05-06', 0),
(21, '50', 'SOAL3', '[\"A\",\"A\",\"B\",\"A\",\"C\"]', '80', '29 menit : 45 detik', '2022-05-06', 0),
(22, '51', 'SOAL3', '[\"A\",\"A\",\"B\",\"A\",\"C\"]', '80', '29 menit : 43 detik', '2022-05-06', 0),
(23, '53', 'SOAL3', '[\"A\",\"A\",\"B\",\"A\",\"C\"]', '80', '29 menit : 40 detik', '2022-05-06', 0),
(24, '54', 'SOAL3', '[\"A\",\"A\",\"B\",\"A\",\"C\"]', '80', '29 menit : 43 detik', '2022-05-06', 0),
(25, '56', 'SOAL3', '[\"A\",\"A\",\"B\",\"A\",\"C\"]', '80', '29 menit : 44 detik', '2022-05-06', 0),
(26, '57', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"C\"]', '60', '29 menit : 39 detik', '2022-05-06', 0),
(27, '58', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"C\"]', '60', '29 menit : 46 detik', '2022-05-06', 0),
(28, '59', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"C\"]', '60', '29 menit : 46 detik', '2022-05-06', 0),
(29, '60', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"C\"]', '60', '29 menit : 45 detik', '2022-05-06', 0),
(30, '61', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"C\"]', '60', '29 menit : 39 detik', '2022-05-06', 0),
(31, '62', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"C\"]', '60', '29 menit : 46 detik', '2022-05-06', 0),
(32, '63', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"C\"]', '60', '29 menit : 44 detik', '2022-05-06', 0),
(33, '64', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"C\"]', '60', '29 menit : 47 detik', '2022-05-06', 0),
(34, '52', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"A\"]', '80', '29 menit : 46 detik', '2022-05-06', 0),
(35, '55', 'SOAL3', '[\"A\",\"A\",\"A\",\"A\",\"A\"]', '80', '29 menit : 40 detik', '2022-05-06', 0),
(36, '46', 'SOAL4', '[\"C\",\"B\",\"B\",\"A\",\"B\"]', '40', '9 menit : 6 detik', '2022-05-07', 0),
(37, '31', 'SOAL4', '[\"C\",\"A\",\"A\",\"A\",\"A\"]', '80', '9 menit : 36 detik', '2022-05-07', 0),
(38, '47', 'SOAL4', '[\"C\",\"A\",\"A\",\"A\",\"A\"]', '80', '9 menit : 43 detik', '2022-05-07', 0),
(39, '48', 'SOAL4', '[\"C\",\"C\",\"A\",\"A\",\"B\"]', '60', '9 menit : 43 detik', '2022-05-07', 0),
(40, '49', 'SOAL4', '[\"C\",\"A\",\"A\",\"A\",\"A\"]', '80', '9 menit : 41 detik', '2022-05-07', 0),
(41, '50', 'SOAL4', '[\"C\",\"B\",\"A\",\"A\",\"B\"]', '60', '9 menit : 43 detik', '2022-05-07', 0),
(42, '51', 'SOAL4', '[\"C\",\"B\",\"A\",\"A\",\"C\"]', '60', '9 menit : 38 detik', '2022-05-07', 0),
(43, '52', 'SOAL4', '[\"A\",\"D\",\"A\",\"C\",\"A\"]', '60', '9 menit : 32 detik', '2022-05-07', 0),
(44, '53', 'SOAL4', '[\"B\",\"D\",\"A\",\"A\",\"A\"]', '80', '9 menit : 44 detik', '2022-05-07', 0),
(45, '54', 'SOAL4', '[\"D\",\"D\",\"A\",\"D\",\"A\"]', '60', '9 menit : 37 detik', '2022-05-07', 0),
(46, '55', 'SOAL4', '[\"D\",\"A\",\"A\",\"A\",\"A\"]', '60', '9 menit : 45 detik', '2022-05-07', 0),
(47, '56', 'SOAL4', '[\"C\",\"B\",\"A\",\"A\",\"A\"]', '80', '9 menit : 46 detik', '2022-05-07', 0),
(48, '57', 'SOAL4', '[\"A\",\"D\",\"A\",\"A\",\"C\"]', '60', '9 menit : 44 detik', '2022-05-07', 0),
(49, '58', 'SOAL4', '[\"C\",\"D\",\"A\",\"A\",\"A\"]', '100', '9 menit : 48 detik', '2022-05-07', 0),
(50, '59', 'SOAL4', '[\"C\",\"A\",\"A\",\"A\",\"B\"]', '60', '9 menit : 47 detik', '2022-05-07', 0),
(51, '60', 'SOAL4', '[\"C\",\"B\",\"A\",\"A\",\"C\"]', '60', '9 menit : 43 detik', '2022-05-07', 0),
(52, '61', 'SOAL4', '[\"C\",\"D\",\"B\",\"C\",\"A\"]', '60', '9 menit : 44 detik', '2022-05-07', 0),
(53, '62', 'SOAL4', '[\"C\",\"D\",\"A\",\"C\",\"B\"]', '60', '9 menit : 46 detik', '2022-05-07', 0),
(54, '63', 'SOAL4', '[\"C\",\"D\",\"A\",\"C\",\"B\"]', '60', '9 menit : 41 detik', '2022-05-07', 0),
(55, '64', 'SOAL4', '[\"C\",\"D\",\"A\",\"A\",\"B\"]', '80', '9 menit : 47 detik', '2022-05-07', 0),
(56, '46', 'SOAL7', '[\"A\",\"C\",\"D\",\"B\",\"B\",\"B\",\"A\",\"A\",\"C\",\"A\"]', '40', '28 menit : 32 detik', '2022-05-16', 0),
(57, '31', 'SOAL7', '[\"A\",\"A\",\"D\",\"A\",\"B\",\"C\",\"A\",\"A\",\"C\",\"A\"]', '50', '29 menit : 17 detik', '2022-05-16', 0),
(58, '48', 'SOAL7', '[\"B\",\"A\",\"B\",\"A\",\"B\",\"C\",\"A\",\"A\",\"C\",\"B\"]', '60', '29 menit : 3 detik', '2022-05-16', 0),
(59, '47', 'SOAL7', '[\"D\",\"A\",\"C\",\"A\",\"B\",\"C\",\"A\",\"A\",\"C\",\"B\"]', '50', '28 menit : 40 detik', '2022-05-16', 0),
(60, '49', 'SOAL7', '[\"A\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\",\"A\",\"C\",\"B\"]', '60', '29 menit : 17 detik', '2022-05-16', 0),
(61, '50', 'SOAL7', '[\"A\",\"C\",\"B\",\"B\",\"B\",\"C\",\"A\",\"A\",\"C\",\"B\"]', '70', '29 menit : 11 detik', '2022-05-16', 0),
(62, '51', 'SOAL7', '[\"A\",\"A\",\"B\",\"A\",\"B\",\"C\",\"A\",\"A\",\"C\",\"B\"]', '70', '29 menit : 27 detik', '2022-05-16', 0),
(63, '52', 'SOAL7', '[\"A\",\"A\",\"D\",\"A\",\"B\",\"C\",\"A\",null,\"C\",\"B\"]', '50', '29 menit : 36 detik', '2022-05-16', 0),
(64, '53', 'SOAL7', '[\"A\",\"C\",\"B\",\"A\",\"B\",\"B\",\"A\",\"A\",\"C\",\"B\"]', '70', '29 menit : 25 detik', '2022-05-16', 0),
(65, '54', 'SOAL7', '[\"C\",\"C\",\"B\",\"A\",\"B\",\"C\",\"A\",\"A\",\"C\",\"B\"]', '70', '29 menit : 24 detik', '2022-05-16', 0),
(66, '55', 'SOAL7', '[\"A\",\"C\",\"C\",\"A\",\"B\",\"C\",\"A\",\"A\",\"C\",\"A\"]', '60', '29 menit : 29 detik', '2022-05-16', 0),
(67, '56', 'SOAL7', '[\"A\",\"C\",\"B\",\"B\",\"B\",\"C\",\"A\",\"A\",\"A\",\"A\"]', '70', '29 menit : 14 detik', '2022-05-16', 0),
(68, '57', 'SOAL7', '[\"C\",\"A\",\"D\",\"B\",\"B\",\"B\",\"A\",\"A\",\"C\",\"A\"]', '20', '29 menit : 28 detik', '2022-05-16', 0),
(69, '58', 'SOAL7', '[\"D\",\"B\",\"C\",\"B\",\"B\",\"C\",\"A\",\"A\",\"C\",\"A\"]', '30', '29 menit : 18 detik', '2022-05-16', 0),
(70, '59', 'SOAL7', '[\"C\",\"A\",\"D\",\"B\",\"B\",\"B\",\"A\",\"A\",\"C\",\"A\"]', '20', '29 menit : 25 detik', '2022-05-16', 0),
(71, '60', 'SOAL7', '[\"D\",\"A\",\"D\",\"B\",\"B\",\"C\",\"A\",\"A\",\"C\",\"A\"]', '30', '29 menit : 25 detik', '2022-05-16', 0),
(72, '61', 'SOAL7', '[\"D\",\"A\",\"C\",\"B\",\"B\",\"C\",\"A\",\"A\",\"C\",\"A\"]', '30', '29 menit : 31 detik', '2022-05-16', 0),
(73, '62', 'SOAL7', '[\"D\",null,\"C\",\"B\",\"B\",\"C\",\"A\",\"A\",\"A\",\"B\"]', '50', '29 menit : 29 detik', '2022-05-16', 0),
(74, '63', 'SOAL7', '[\"D\",\"A\",\"C\",\"B\",\"B\",\"C\",\"A\",\"A\",\"C\",\"A\"]', '30', '29 menit : 27 detik', '2022-05-16', 0),
(75, '64', 'SOAL7', '[\"D\",\"A\",\"C\",\"A\",\"B\",\"C\",\"A\",\"A\",\"C\",\"A\"]', '40', '29 menit : 31 detik', '2022-05-16', 0),
(76, '46', 'SOAL8', '[\"C\",\"A\",\"A\",\"C\",\"A\",\"C\",\"D\",\"C\",\"B\",\"D\"]', '60', '57 menit : 33 detik', '2022-05-16', 0),
(77, '31', 'SOAL8', '[\"C\",\"A\",\"C\",\"C\",\"A\",\"A\",\"A\",\"A\",\"D\",\"D\"]', '50', '58 menit : 29 detik', '2022-05-16', 0),
(78, '47', 'SOAL8', '[\"C\",\"A\",\"C\",\"A\",\"A\",\"A\",\"C\",\"A\",\"C\",\"A\"]', '50', '59 menit : 12 detik', '2022-05-16', 0),
(79, '48', 'SOAL8', '[\"A\",\"A\",\"A\",\"C\",\"A\",\"A\",\"C\",\"A\",\"B\",\"A\"]', '40', '59 menit : 10 detik', '2022-05-16', 0),
(80, '49', 'SOAL8', '[\"A\",\"A\",\"A\",\"A\",\"A\",\"D\",\"A\",\"D\",\"B\",\"C\"]', '40', '59 menit : 25 detik', '2022-05-16', 0),
(81, '50', 'SOAL8', '[\"C\",\"A\",\"A\",\"C\",\"A\",\"A\",\"C\",\"A\",\"B\",\"A\"]', '50', '58 menit : 52 detik', '2022-05-16', 0),
(82, '51', 'SOAL8', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"C\",\"A\",\"B\",\"A\"]', '70', '59 menit : 19 detik', '2022-05-16', 0),
(83, '52', 'SOAL8', '[\"C\",\"A\",\"A\",\"A\",\"A\",\"A\",\"C\",\"A\",\"B\",\"A\"]', '60', '59 menit : 23 detik', '2022-05-16', 0),
(84, '53', 'SOAL8', '[\"C\",\"A\",\"A\",\"A\",\"A\",\"A\",\"C\",\"A\",\"B\",\"A\"]', '60', '59 menit : 30 detik', '2022-05-16', 0),
(85, '54', 'SOAL8', '[\"C\",\"A\",\"D\",\"A\",\"A\",\"A\",\"C\",\"B\",\"B\",\"D\"]', '90', '59 menit : 32 detik', '2022-05-16', 0),
(86, '55', 'SOAL8', '[\"C\",\"A\",\"A\",\"A\",\"A\",\"A\",\"C\",\"C\",\"B\",\"A\"]', '60', '59 menit : 29 detik', '2022-05-16', 0),
(87, '56', 'SOAL8', '[\"C\",\"A\",\"A\",\"A\",\"A\",\"C\",\"D\",\"B\",\"B\",\"D\"]', '80', '59 menit : 29 detik', '2022-05-16', 0),
(88, '57', 'SOAL8', '[\"C\",\"A\",\"A\",\"A\",\"A\",\"B\",\"C\",\"A\",\"B\",\"A\"]', '50', '59 menit : 34 detik', '2022-05-16', 0),
(89, '58', 'SOAL8', '[\"C\",\"A\",\"A\",\"A\",\"A\",\"B\",\"C\",\"B\",\"C\",\"D\"]', '60', '59 menit : 32 detik', '2022-05-16', 0),
(90, '59', 'SOAL8', '[\"C\",\"C\",\"B\",\"A\",\"A\",\"B\",\"A\",\"A\",\"A\",\"D\"]', '40', '59 menit : 33 detik', '2022-05-16', 0),
(91, '60', 'SOAL8', '[\"C\",\"A\",\"A\",\"A\",\"A\",\"B\",\"C\",\"B\",\"B\",\"A\"]', '60', '59 menit : 27 detik', '2022-05-16', 0),
(92, '61', 'SOAL8', '[\"C\",\"A\",\"A\",\"C\",\"A\",\"A\",\"D\",\"A\",\"B\",\"A\"]', '60', '59 menit : 37 detik', '2022-05-16', 0),
(93, '62', 'SOAL8', '[\"A\",\"A\",\"A\",\"C\",\"A\",\"B\",\"C\",\"B\",\"B\",\"A\"]', '40', '59 menit : 35 detik', '2022-05-16', 0),
(94, '63', 'SOAL8', '[\"A\",\"A\",\"A\",\"C\",\"A\",\"A\",\"C\",\"B\",\"B\",\"A\"]', '50', '59 menit : 34 detik', '2022-05-16', 0),
(95, '64', 'SOAL8', '[\"A\",\"A\",\"A\",\"C\",\"A\",\"A\",\"B\",\"A\",\"C\",\"A\"]', '30', '59 menit : 34 detik', '2022-05-16', 0),
(96, '46', 'SOAL9', '[\"A\",\"C\",\"D\",\"D\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '80', '58 menit : 44 detik', '2022-05-16', 0),
(97, '31', 'SOAL9', '[\"A\",\"C\",\"C\",\"D\",\"A\",\"B\",\"A\",\"C\",\"B\",\"A\"]', '60', '59 menit : 17 detik', '2022-05-16', 0),
(98, '47', 'SOAL9', '[\"A\",\"C\",\"C\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '80', '59 menit : 13 detik', '2022-05-16', 0),
(99, '48', 'SOAL9', '[\"A\",\"C\",\"C\",\"C\",\"A\",\"B\",\"A\",\"B\",\"D\",\"A\"]', '70', '59 menit : 13 detik', '2022-05-16', 0),
(100, '49', 'SOAL9', '[\"A\",\"C\",\"C\",\"C\",\"A\",\"B\",\"A\",\"B\",\"D\",\"B\"]', '60', '59 menit : 23 detik', '2022-05-16', 0),
(101, '50', 'SOAL9', '[\"A\",\"C\",\"D\",\"D\",\"A\",\"B\",\"A\",\"B\",\"B\",\"B\"]', '70', '59 menit : 25 detik', '2022-05-16', 0),
(102, '51', 'SOAL9', '[\"A\",\"C\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '90', '59 menit : 2 detik', '2022-05-16', 0),
(103, '52', 'SOAL9', '[\"A\",\"D\",\"C\",\"C\",\"A\",\"B\",\"A\",\"B\",\"D\",\"A\"]', '80', '59 menit : 23 detik', '2022-05-16', 0),
(104, '53', 'SOAL9', '[\"A\",\"D\",\"C\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"B\"]', '80', '59 menit : 26 detik', '2022-05-16', 0),
(105, '54', 'SOAL9', '[\"A\",\"D\",\"C\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '90', '59 menit : 30 detik', '2022-05-16', 0),
(106, '55', 'SOAL9', '[\"A\",\"C\",\"C\",\"D\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '70', '59 menit : 28 detik', '2022-05-16', 0),
(107, '56', 'SOAL9', '[\"A\",\"D\",\"C\",\"C\",\"A\",\"B\",\"A\",\"B\",\"A\",\"A\"]', '80', '59 menit : 29 detik', '2022-05-16', 0),
(108, '57', 'SOAL9', '[\"A\",\"C\",\"D\",\"C\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '90', '59 menit : 29 detik', '2022-05-16', 0),
(109, '58', 'SOAL9', '[\"A\",\"C\",\"C\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"B\"]', '60', '59 menit : 23 detik', '2022-05-16', 0),
(110, '59', 'SOAL9', '[\"A\",\"C\",\"C\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"B\"]', '60', '59 menit : 19 detik', '2022-05-16', 0),
(111, '60', 'SOAL9', '[\"A\",\"C\",\"C\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '70', '59 menit : 34 detik', '2022-05-16', 0),
(112, '61', 'SOAL9', '[\"A\",\"C\",\"C\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '70', '59 menit : 24 detik', '2022-05-16', 0),
(113, '62', 'SOAL9', '[\"A\",\"C\",\"C\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '70', '59 menit : 29 detik', '2022-05-16', 0),
(114, '63', 'SOAL9', '[\"A\",\"C\",\"D\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '80', '59 menit : 26 detik', '2022-05-16', 0),
(115, '64', 'SOAL9', '[\"A\",\"C\",\"D\",\"B\",\"A\",\"B\",\"A\",\"B\",\"B\",\"A\"]', '80', '59 menit : 23 detik', '2022-05-16', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_rencana`
--

CREATE TABLE `t_rencana` (
  `rencana_id` int(11) NOT NULL,
  `rencana_pelajaran` text NOT NULL,
  `rencana_user` text NOT NULL,
  `rencana_kelas` text NOT NULL,
  `rencana_isi` text NOT NULL,
  `rencana_file` text NOT NULL,
  `rencana_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_rencana`
--

INSERT INTO `t_rencana` (`rencana_id`, `rencana_pelajaran`, `rencana_user`, `rencana_kelas`, `rencana_isi`, `rencana_file`, `rencana_tanggal`) VALUES
(1, '1', '8', '1,2,3', '<ul>\r\n	<li>Berikut ini adalah Rencana Pembelajaran Semester (RPS) untuk Mata Kuliah Analisis dan Perancangan Sistem Informasi.&nbsp;</li>\r\n	<li>Silahkan diunduh untuk dipelajari agar memudahkan dalam mempersiapkan diri sebelum kegiatan belajar dimulai.</li>\r\n	<li>Pada kolom paling kanan terdapat&nbsp;persentase nilai di setiap kegiatan belajar yang dapat digunakan oleh mahasiswa untuk memperkirakan nilai akhir.</li>\r\n</ul>\r\n', '3380230fad1f2c12a6ee3da340c88a27.pdf', '2022-03-26'),
(2, '4', '28', '9', '<ul>\r\n	<li>Berikut adalah Rencana Pembelajaran Semester (RPS) Mata Kuliah Analsis dan Perancangan Sistem Informasi.</li>\r\n	<li>Silahkan unduh dan pelajari agar dapat mempersiapkan diri sebelum kegiatan belajar dimulai.</li>\r\n	<li>Kolom paling kanan adalah persentasi bobot nilai untuk setiap kegiatan belajar dan UAS, hal ini penting untuk diketahui agar dapat memperkirakan total nilai yang diperoleh.</li>\r\n</ul>\r\n', 'c00303e6682d30e10aa3de8940bce945.pdf', '2022-04-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_semester`
--

CREATE TABLE `t_semester` (
  `semester_id` int(11) NOT NULL,
  `semester_no` text NOT NULL,
  `semester_pertemuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_semester`
--

INSERT INTO `t_semester` (`semester_id`, `semester_no`, `semester_pertemuan`) VALUES
(7, '4', '16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_tujuan`
--

CREATE TABLE `t_tujuan` (
  `tujuan_id` int(11) NOT NULL,
  `tujuan_pelajaran` text NOT NULL,
  `tujuan_user` text NOT NULL,
  `tujuan_kelas` text NOT NULL,
  `tujuan_isi` text NOT NULL,
  `tujuan_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_tujuan`
--

INSERT INTO `t_tujuan` (`tujuan_id`, `tujuan_pelajaran`, `tujuan_user`, `tujuan_kelas`, `tujuan_isi`, `tujuan_tanggal`) VALUES
(1, '1', '8', '1,2,3', '<p>Tujuan mempelajari mata kuliah Analisis dan Perancangan Sistem Informasi (APSI) secara umum adalah agar <strong>setelah mempelajari mata kuliah APSI mahasiswa akan mampu melakukan kegiatan analisis dan perancangan sistem informasi sesuai dengan kebutuhan pengguna dengan penggunaan metode pengembangan sistem dan perangkat perancangan sistem dengan baik. </strong></p>\r\n\r\n<p>Setelah mempelajari matakuliah ini secara khusus diharapkan :</p>\r\n\r\n<ol>\r\n	<li>Mahasiswa akan mampu menjelaskan konsep dasar sistem informasi dengan benar.</li>\r\n	<li>Mahasiswa akan mampu menentukan metodologi pengembangan sistem informasi yang tepat sesuai dengan kondisi dan sumber daya yang tersedia.</li>\r\n	<li>Mahasiswa akan mampu merumuskan saran perbaikan dengan logika yang benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan sistem dengan penggunaan <em>Flow of Document</em> dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan fungsional dengan penggunaan Diagram Use Case dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan proses bisnis dengan penggunaan Diagram Aktivitas dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan perilaku dengan penggunaan Diagram Urutan dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan struktural dengan penggunaan Diagram Kelas dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang arsitektur program dengan<strong> </strong>logika yang benar.</li>\r\n	<li>Mahasiswa akan mampu merancang tampilan layar dengan<strong> </strong>logika yang benar.</li>\r\n</ol>\r\n', '2022-03-24'),
(2, '4', '28', '9', '<p>Tujuan mempelajari mata kuliah Analisis dan Perancangan Sistem Informasi (APSI) secara umum adalah agar <strong>setelah mempelajari mata kuliah APSI mahasiswa akan mampu melakukan kegiatan analisis dan perancangan sistem informasi sesuai dengan kebutuhan pengguna melalui&nbsp;penggunaan metode pengembangan sistem dan perangkat perancangan sistem dengan baik. </strong></p>\r\n\r\n<p>Setelah mempelajari matakuliah ini secara khusus diharapkan :</p>\r\n\r\n<ol>\r\n	<li>Mahasiswa akan mampu menjelaskan konsep dasar sistem informasi dengan benar.</li>\r\n	<li>Mahasiswa akan mampu menentukan metodologi pengembangan sistem informasi yang tepat sesuai dengan kondisi dan sumber daya yang tersedia.</li>\r\n	<li>Mahasiswa akan mampu merumuskan saran perbaikan dengan logika yang benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan sistem melalui penggunaan <em>Flow of Document</em> dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan fungsional melalui penggunaan Diagram Use Case dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan proses bisnis melalui penggunaan Diagram Aktivitas dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan perilaku melalui penggunaan Diagram Urutan dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang pemodelan struktural melalui penggunaan Diagram Kelas dengan<strong> </strong>benar.</li>\r\n	<li>Mahasiswa akan mampu merancang arsitektur program dengan<strong> </strong>logika yang benar.</li>\r\n	<li>Mahasiswa akan mampu merancang tampilan layar dengan<strong> </strong>logika yang benar.</li>\r\n</ol>\r\n', '2022-04-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_ujian_essay`
--

CREATE TABLE `t_ujian_essay` (
  `ujian_essay_id` text NOT NULL,
  `ujian_essay_pelaksanaan` datetime DEFAULT NULL,
  `ujian_essay_judul` text NOT NULL,
  `ujian_essay_semester` text NOT NULL,
  `ujian_essay_pertemuan` text NOT NULL,
  `ujian_essay_durasi` text NOT NULL,
  `ujian_essay_petunjuk` text NOT NULL,
  `ujian_essay_guru` text NOT NULL,
  `ujian_essay_kelas` text NOT NULL,
  `ujian_essay_pelajaran` text NOT NULL,
  `ujian_essay_jumlah` text NOT NULL,
  `ujian_essay_text` text NOT NULL,
  `ujian_essay_tanggal` date DEFAULT curdate(),
  `ujian_essay_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_ujian_essay`
--

INSERT INTO `t_ujian_essay` (`ujian_essay_id`, `ujian_essay_pelaksanaan`, `ujian_essay_judul`, `ujian_essay_semester`, `ujian_essay_pertemuan`, `ujian_essay_durasi`, `ujian_essay_petunjuk`, `ujian_essay_guru`, `ujian_essay_kelas`, `ujian_essay_pelajaran`, `ujian_essay_jumlah`, `ujian_essay_text`, `ujian_essay_tanggal`, `ujian_essay_hapus`) VALUES
('SOAL1', '2022-04-17 05:12:00', 'UAS', '4', '11', '10', 'Berikan jawaban yang tepat dan lengkap ', '28', '9', '4', '1', '{\"ujian_essay_jumlah\":\"1\",\"ujian_essay_id\":\"SOAL1\",\"ujian_essay_semester\":\"4\",\"ujian_essay_pertemuan\":\"11\",\"ujian_essay_judul\":\"UAS\",\"ujian_essay_pelajaran\":\"4\",\"ujian_essay_kelas\":[\"9\"],\"ujian_essay_pelaksanaan\":\"2022-04-17T05:12\",\"ujian_essay_durasi\":\"10\",\"ujian_essay_petunjuk\":\"Berikan jawaban yang tepat dan lengkap \",\"soal1\":\"Sebagai seorang analis sistem, anda diminta untuk menentukan tingkat kelayakan kebutuhan sistem baru berdasarkan permasalahan yang ada ditinjau dari beberapa aspek, yaitu aspek ekonomi, teknik, operasional dan hukum.\\r\\n\",\"gambar1\":\"SOAL1_1\"}', '2022-04-16', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_ujian_essay_hasil`
--

CREATE TABLE `t_ujian_essay_hasil` (
  `ujian_essay_hasil_id` int(11) NOT NULL,
  `ujian_essay_hasil_durasi_sisa` text NOT NULL,
  `ujian_essay_hasil_siswa` text NOT NULL,
  `ujian_essay_hasil_soal` text NOT NULL,
  `ujian_essay_hasil_jawaban` text NOT NULL,
  `ujian_essay_hasil_nilai` text NOT NULL,
  `ujian_essay_hasil_nilai_total` text NOT NULL,
  `ujian_essay_hasil_pengkoreksi` text NOT NULL,
  `ujian_essay_hasil_tanggal` date NOT NULL DEFAULT curdate(),
  `ujian_essay_hasil_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_ujian_essay_hasil`
--

INSERT INTO `t_ujian_essay_hasil` (`ujian_essay_hasil_id`, `ujian_essay_hasil_durasi_sisa`, `ujian_essay_hasil_siswa`, `ujian_essay_hasil_soal`, `ujian_essay_hasil_jawaban`, `ujian_essay_hasil_nilai`, `ujian_essay_hasil_nilai_total`, `ujian_essay_hasil_pengkoreksi`, `ujian_essay_hasil_tanggal`, `ujian_essay_hasil_hapus`) VALUES
(1, '9 menit : 34 detik', '29', 'SOAL1', '{\"id\":\"SOAL1\",\"timer\":\"9 menit : 34 detik\",\"jawab1\":\"1)\\tKelayakan kebutuhan sistem baru ditinjau dari beberapa aspek, yaitu aspek ekonomi, teknik, operasional dan hukum.\\r\\na)\\tKelayakan teknis\\r\\nKelayakan teknis menyoroti kebutuhan sistem dari aspek teknologi yang akan digunakan. Aplikasi sistem pakar pendeteksi penyakit pada tanaman semangka nantinya akan mudah didapat karena dapat diunduh secara gratis di Play Store, mudah digunakan dan dapat dioperasikan dengan smartphone berbasis Android yang tersedia di pasaran.\\r\\nb)\\tKelayakan Operasional.\\r\\nUntuk memenuhi layak secara operasional, sistem harus dapat menyelesaikan masalah yang ada di sisi pengguna. Pada penelitian ini aplikasi sistem pakar dibangun berdasarkan kebutuhan para petani semangka yang diperoleh dari hasil wawancara dengan petani semangka di UD Sasak Tani sehingga nantinya akan dapat membantu petani dalam mendeteksi penyakit pada tanaman semangka dan memberikan langkah-langkah penanganannya yang tepat didasarkan pada teori terkait.\\r\\nc)\\tKelayakan ekonomi\\r\\nKelayakan ekonomi mempertimbangkan manfaat yang diperoleh dibandingkan dengan biaya yang dikeluarkan. Harga smartphone saat ini sangat variatif bahkan dengan harga di bawah 1 juta rupiah, sedangkan manfaat yang diperoleh adalah petani dapat melakukan upaya-upaya pencegahan dan pengobatan terhadap tanaman semangka sehingga hasil panen akan maksimal.\\r\\nd)\\tKelayakan hukum\\r\\nKelayakan hukum berhubungan dengan pemenuhan aturan dan undang-undang. Aplikasi sistem pakar pendeteksi penyakit pada tanaman semangka dibangun dengan perangkat lunak legal dan tidak menyalahi aturan dan undang-undang.\\r\\n\"}', '{\"jumlah\":\"1\",\"nilai1\":\"80\"}', '80', '28', '2022-04-16', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_ujian_pilihan`
--

CREATE TABLE `t_ujian_pilihan` (
  `ujian_pilihan_id` text NOT NULL,
  `ujian_pilihan_pelaksanaan` datetime DEFAULT NULL,
  `ujian_pilihan_judul` text NOT NULL,
  `ujian_pilihan_semester` text NOT NULL,
  `ujian_pilihan_pertemuan` text NOT NULL,
  `ujian_pilihan_durasi` text NOT NULL,
  `ujian_pilihan_kesempatan` text NOT NULL,
  `ujian_pilihan_petunjuk` text NOT NULL,
  `ujian_pilihan_jumlah` text NOT NULL,
  `ujian_pilihan_pertanyaan` text NOT NULL,
  `ujian_pilihan_pelajaran` text NOT NULL,
  `ujian_pilihan_kelas` text NOT NULL,
  `ujian_pilihan_tanggal` date DEFAULT NULL,
  `ujian_pilihan_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_ujian_pilihan_hasil`
--

CREATE TABLE `t_ujian_pilihan_hasil` (
  `ujian_pilihan_hasil_id` int(11) NOT NULL,
  `ujian_pilihan_hasil_materi` text NOT NULL,
  `ujian_pilihan_hasil_siswa` text NOT NULL,
  `ujian_pilihan_hasil_soal` text NOT NULL,
  `ujian_pilihan_hasil_jawaban` text NOT NULL,
  `ujian_pilihan_hasil_nilai` text NOT NULL,
  `ujian_pilihan_hasil_sisa` text NOT NULL,
  `ujian_pilihan_hasil_kesempatan` text NOT NULL,
  `ujian_pilihan_hasil_tanggal` date DEFAULT curdate(),
  `ujian_pilihan_hasil_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `user_email_2` text DEFAULT NULL,
  `user_tanggal` date DEFAULT curdate(),
  `user_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_email`, `user_password`, `user_name`, `user_ttl`, `user_nohp`, `user_alamat`, `user_biodata`, `user_foto`, `user_level`, `user_pelajaran`, `user_kelas`, `user_email_2`, `user_tanggal`, `user_hapus`) VALUES
(5, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin ( Eclassroom )', '2021-11-09', '085555111555', 'Alamat', 'Biodata', 'da0d5a93eff6430061c9d37e226f9706.png', 1, NULL, NULL, NULL, '2022-04-17', 0),
(8, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, NULL, NULL, NULL, '2b7f17484649491a75ce7c1437de282a.png', 2, NULL, 'null', NULL, '2022-04-17', 0),
(9, '2222', '934b535800b1cba8f96a5d72f72f1611', 'Valentino Rossi', '0000-00-00', '', '', '', '5c15e0858a02a69d8ecce9a664037a31.png', 2, '2', NULL, NULL, '2022-04-17', 0),
(11, '3333', '2be9bd7a3434f7038ca27d1918de58bd', 'Uciha Sasuke', NULL, NULL, NULL, NULL, 'Riandaka_4.png', 3, NULL, '1', 'sasuke@gmail.com', '2021-11-28', 1),
(12, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2021-11-28', 0),
(28, '0831128410', '57ca8824cbac28319cfc4f054e4206c2', 'Juhartini, S.Kom., M.Kom', '1984-12-31', '087863683287', 'Dasan Tapen-Gerung. Kabupaten Lombok Barat', '', '5860a60572ffce497daa054d4d676afe.jpeg', 2, '4', 'null', NULL, '2022-04-15', 0),
(29, '19SI123', 'd5447ff998160f6706e013fcb5f8321f', 'Hendri', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'hendri@gmail.com', '2022-04-14', 0),
(30, '19SI001', '76ced2d746d973f1f860a27061d96e62', 'Nasir', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'nasir@gmail.com', '2022-04-16', 0),
(31, '20SI002', 'b776596cf0983dba3619c50d411d2c28', 'Baiq Nastasya', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'tasya@gmail.com', '2022-04-17', 0),
(32, '19SI007', 'e81c687ee3a9b14e4a5b10100d8670d1', 'ST. Tuhpatussania', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'asna@gmail.com', '2022-04-17', 0),
(33, '18SI002', 'a147dfd38a5b241b0a2ec32738ccad1b', 'Maria Goreti Owa', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'mariagoreti@gmail.com', '2022-04-18', 0),
(34, '18SI038', '5298c52e7c82ee8294502e98a459e175', 'Delima', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'delima@gmail.com', '2022-04-18', 0),
(35, '18SI055', '0a0d4e062e5400d0520ed7cb1312df41', 'Wulan Sari', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'wulan_sari@gmail.com', '2022-04-18', 0),
(36, '18SI031', '7cecdbc2cf948b7233b65c9a4c10e7f9', 'Abdullah Harmain', '1999-02-14', '6285205133314', '', '', 'cc8b96f58eac700056df8a2ddcb5a5d4.jpg', 3, NULL, '9', 'harmain@gmail.com', '2022-04-25', 0),
(37, '18SI033', 'b8faf66a47c0a7de8e2850b210c02541', 'Ahmad Zamharir', '1999-10-16', '095205209819', 'Gondang', '', 'd4e650475c6c1d69c394e0ae3700cb43.jpg', 3, NULL, '9', 'zamharir@gmail.com', '2022-04-25', 0),
(38, '18SI044', '0a5d098cbec1ae958198b5d9f24ec4d8', 'Raehatul Hasanah', '0000-00-00', '', '', '', '9c43e289c705550d79827c17c871f1bb.jpg', 3, NULL, '9', 'raehatul@gmail.com', '2022-04-25', 0),
(39, '18SI008', '73c6b8f4d0f25ef534280ce576a7ce00', 'Yudi Alfandi', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'alfandi_yudi@gmail.com', '2022-04-25', 0),
(40, '18SI061', '81dc9bdb52d04dc20036dbd8313ed055', 'Zayyan Anggreyani Putri', '0000-00-00', '', '', '', 'c3cd0e387a21a7f5f990c9bc3014be6c.jpg', 3, NULL, '9', 'zayyan_ap@gmail.com', '2022-04-25', 0),
(41, '18SI131', 'be7982fb79c6dd2876c1cbfb01703da0', 'Aria Wangsa Sanjaya', '0000-00-00', '', '', '', '24cc3c9792c93f6cb51b273b592c3a1a.jpg', 3, NULL, '9', 'aria_aryo@gmail.com', '2022-04-25', 0),
(42, '18SI093', '1160865790f1b3c6e85642fdcc63a3b3', 'Denda Apsih', '0000-00-00', '082341458570', '', '', NULL, 3, NULL, '9', 'denda_apsih@gmail.com', '2022-04-25', 0),
(43, '18SI083', 'b5420e1b2d2799a20fa6600493cbad29', 'Lilik Fatmawati Yuliana', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'lilik_fy@gmail.com', '2022-04-25', 0),
(44, '18SI021', '4fb5b0fc69d15bf3872e300329683f54', 'Ruli Pandini', '0000-00-00', '', '', '', NULL, 3, NULL, '9', 'pandini.ruli@gmail.com', '2022-04-25', 0),
(45, '18SI090', '53d1ed199042b91a94246624c5b9ddc1', 'Ziadatunnikmah', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'ziadatunnikmah@gmail.com', '2022-04-25', 0),
(46, '20SI001', '4115de542272db37bb9bc5a37692b0f0', 'Aida Safitri', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'aidasafitri@gmail.com', '2022-04-25', 0),
(47, '20SI005', 'a55a019061566ce0f9a143018103e6f3', 'Azziadati', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'azziadati@gmail.com', '2022-04-25', 0),
(48, '20SI007', 'd1359a06146921ff8a35425c2a6db9ac', 'Baiq Sri Warni', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'baiqsri@gmail.com', '2022-04-25', 0),
(49, '20SI012', '1b0e5c14db6df2c8a801965d82c67968', 'Jamyatul Lady Annisa', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'ladyannisa@gmail.com', '2022-04-25', 0),
(50, '20SI016', '0218bf7270da9b007df43b0ce6eb413c', 'Lusi Wulanda Ningsih', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'lusiwulanda@gmail.com', '2022-04-25', 0),
(51, '20SI019', 'f07e5fccbdd1ea62f8f25a8a6bb6e3e1', 'Nurlaili', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'nurlaili@gmail.com', '2022-04-25', 0),
(52, '20SI030', '19665f15a459300e3d14034ec756affe', 'Sri Mulianingsih', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'mulianingsih@gmail.com', '2022-04-25', 0),
(53, '20SI031', '6be607dcbe8fd2fb9136569643dcf48c', 'Suci Rahmawati', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'suci.rahmawati@gmail.com', '2022-04-25', 0),
(54, '20SI036', 'db8902915f7ad3818e192790f17a1338', 'Arya Eka Nugroho', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'aryaeka@gmail.com', '2022-04-25', 0),
(55, '20SI045', '552279faebbce80c94a90f6954586ce0', 'M. Rizki Ramani', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'rizkiramani@gmail.com', '2022-04-25', 0),
(56, '20SI004', 'e8cd5226a7c2fddf40a20d1be70e070d', 'Audi Latifa Yasmin', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'audi.yasmin@gmail.com', '2022-04-26', 0),
(57, '20SI010', 'b4838bdd9b16d4c11e68283f028d1e30', 'Hapni Tamara Suci', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'hapni.tamara@gmail.com', '2022-04-26', 0),
(58, '20SI017', '3ec667b4f3ba56e2dd8b73bdb8a5a2cf', 'Diki Irawan', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'diki.irawan@gmail.com', '2022-04-26', 0),
(59, '20SI034', '541d369b5d10620295be913d3cf4a303', 'Agus Hariawan', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'agus.hari@gmail.com', '2022-04-26', 0),
(60, '20SI041', '99ac369a47b16bfaec5cee9c064b7365', 'Irgi Ahmad Fahrul Rozi', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'irgi.ahmad@gmail.com', '2022-04-26', 0),
(61, '20SI042', '7b774f2d91a3860aedf30466a7d217bf', 'M. Habib Rizeiq', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'habib.rizeiq@gmail.com', '2022-04-26', 0),
(62, '20SI046', '01b81f9b0a65a0a3c95d25f7d0fcb8c9', 'M. Afiat Juniardi', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'afiat.juniardi@gmail.com', '2022-04-26', 0),
(63, '20SI048', 'd250951a6052da539f67103ff5b861ed', 'Rismayadi Hidayat', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'rismayadi.hidayat@gmail.com', '2022-04-26', 0),
(64, '20SI050', '9eabdeabb1cba2ac5a9de428697ae63c', 'Septi Ryanto Saputra', NULL, NULL, NULL, NULL, NULL, 3, NULL, '9', 'septi.ryan@gmail.com', '2022-04-26', 0);

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
(1, 'Video Pertemuan Pertama', '7', NULL, 'DA6QaZ5M71w', '2022-04-17', 1),
(2, 'Konsep Sistem, Informasi dan Sistem Informasi', '7', NULL, 'https://youtu.be/fxgHlHF31DA', '2022-04-17', 1),
(3, 'Konsep Sistem, Informasi dan Sistem Informasi', '7', NULL, 'https://youtu.be/fxghlhf31da', '2022-04-17', 1),
(4, 'Konsep Sistem, Informasi dan Sistem Informasi', '7', NULL, 'fxgHlHF31DA', '2022-04-17', 0),
(5, 'Konsep Sistem Informasi', '7', NULL, 'p95KOG5PiXk', '2022-04-17', 0),
(6, 'Metodologi Pengembangan Sistem', '9', NULL, 'dDcSw5d1-Ig', '2022-04-17', 0),
(7, 'Perbandingan antara  metodologi SDLC, Agile dan Scrum', '9', NULL, 'JF4R4mwsGgE', '2022-04-17', 0),
(8, 'Konsep OOAD', '9', NULL, 'AuvW1DsH89k', '2022-04-17', 0),
(9, 'Prototyping', '9', NULL, 'C34yLq8jbnc', '2022-04-17', 0),
(10, 'Metodologi Pengembangan Evolusioner', '9', NULL, 'cKZXrh3p4vA', '2022-04-17', 0),
(11, 'Memahami Requirement Analysis atau Analisa Kebutuhan dalam Pengembangan Sistem Informasi', '10', NULL, 'lX1RuDnEKEI', '2022-04-17', 0),
(12, 'Studi Kelayakan Sistem', '10', NULL, 'HF2RTReX5hM', '2022-04-17', 0),
(13, 'Metode Pengumpulan Data', '10', NULL, 'Tqy9ApYbb7E', '2022-04-17', 0),
(14, 'Jenis-jenis Data', '10', NULL, '02cR8Fp-hKA', '2022-04-17', 0),
(15, 'Simbol-Simbol Flow of Document', '11', NULL, 'CkljgqpVYgQ', '2022-04-17', 0),
(16, 'Tutorial Membuat Flow of Document 1', '11', NULL, 'SWC7x026GLk', '2022-04-17', 0),
(17, 'Tutorial Membuat Flow of Document-2', '11', NULL, 'Tnr1AMIb5Ss', '2022-04-17', 0),
(18, 'Menggambar Flow of Document menggunakan Ms. Word', '11', NULL, 'd8guzYDlqzU', '2022-04-17', 0),
(19, 'Menggambar Flow of Document menggunakan Ms. Visio', '11', NULL, 'B8lEYzLxXfk', '2022-04-17', 0),
(20, 'Menggambar Flow of Document menggunakan Edraw Max', '11', NULL, 'F97Sb2wFWzA', '2022-04-17', 0),
(21, 'Menggambar Flow of Document menggunakan Draw IO', '11', NULL, 'b_ViO5b3Y6A', '2022-04-17', 0),
(22, 'Menggambar Flow of Document menggunakan Star UML', '11', NULL, 'N-0To-ueBmc', '2022-04-17', 0),
(23, 'Pengenalan UML', '12', NULL, 'effllCzc2Ug', '2022-04-17', 0),
(24, 'Diagram Use Case', '12', NULL, 'eJ3YJMRQTvA', '2022-04-17', 0),
(25, 'Diagram Use Case : Contoh 1', '12', NULL, 'bc6rUCQYhG0', '2022-04-17', 0),
(26, 'Diagram Use Case : Contoh 2', '12', NULL, 'IXucpSw0PRc', '2022-04-17', 0),
(27, 'Diagram Aktivitas', '13', NULL, 'vICQ1OVaZ0k', '2022-04-17', 0),
(28, 'Diagram Aktivitas : Contoh 1', '13', NULL, 'bXoYAK6KaL4', '2022-04-17', 0),
(29, 'Diagram Aktivitas :  Contoh 2', '13', NULL, '_5JojE1mYOY', '2022-04-17', 0),
(30, 'DIagram Urutan : Contoh 1', '14', NULL, '_DE4pXSDivU', '2022-04-17', 0),
(31, 'DIagram Urutan', '14', NULL, 'ZGW-N10ByuM', '2022-04-17', 0),
(32, 'Diagram Urutan : Contoh 2', '14', NULL, 'vyvg607NLMs', '2022-04-17', 0),
(33, 'Membuat Diagram Urutan dengan Ms. Visio', '14', NULL, 'DqWcOKpcUxE', '2022-04-17', 0),
(34, 'Diagram Kelas : Notasi dan Visibility', '15', NULL, 'ZplESzpsCGs', '2022-04-17', 0),
(35, 'DIagram Kelas :Multiplicity', '15', NULL, '9xmfemx0pQM', '2022-04-17', 0),
(36, 'Diagram Kelas : Inheritance', '15', NULL, 'HGVaTNhpUSY', '2022-04-17', 0),
(37, 'Composition', '15', NULL, 'eNCbZl_PYR0', '2022-04-17', 0),
(38, 'Diagram Kelas : Aggregation', '15', NULL, 'F0iG47N5M7M', '2022-04-17', 0),
(39, 'Diagram Kelas : Dependency', '15', NULL, '5Kw3gYI4IW8', '2022-04-17', 0),
(40, 'Diagram Kelas : Contoh 1', '15', NULL, 'Qs0h_ohwXrQ', '2022-04-17', 0),
(41, 'Diagram Kelas : Contoh 2', '15', NULL, 'rOWPvRNKBSE', '2022-04-17', 0),
(42, 'Membuat Diagram Kelas dengan Star UML', '15', NULL, 'Qqz7w2SlKLo', '2022-04-17', 0),
(43, 'Diagram HIPO', '16', NULL, '3HkUUSjP1dQ', '2022-04-17', 0),
(44, 'Perancangan Antar Muka Pengguna', '17', NULL, '6GRRkyAE1RM', '2022-04-17', 0);

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
-- Indeks untuk tabel `t_collassion`
--
ALTER TABLE `t_collassion`
  ADD PRIMARY KEY (`collassion_id`);

--
-- Indeks untuk tabel `t_diskusi`
--
ALTER TABLE `t_diskusi`
  ADD PRIMARY KEY (`diskusi_id`);

--
-- Indeks untuk tabel `t_formative_hasil`
--
ALTER TABLE `t_formative_hasil`
  ADD PRIMARY KEY (`formative_hasil_id`);

--
-- Indeks untuk tabel `t_informasi`
--
ALTER TABLE `t_informasi`
  ADD PRIMARY KEY (`informasi_id`);

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
-- Indeks untuk tabel `t_latihan_hasil`
--
ALTER TABLE `t_latihan_hasil`
  ADD PRIMARY KEY (`latihan_hasil_id`);

--
-- Indeks untuk tabel `t_materi`
--
ALTER TABLE `t_materi`
  ADD PRIMARY KEY (`materi_id`);

--
-- Indeks untuk tabel `t_modul`
--
ALTER TABLE `t_modul`
  ADD PRIMARY KEY (`modul_id`);

--
-- Indeks untuk tabel `t_panduan`
--
ALTER TABLE `t_panduan`
  ADD PRIMARY KEY (`panduan_id`);

--
-- Indeks untuk tabel `t_pelajaran`
--
ALTER TABLE `t_pelajaran`
  ADD PRIMARY KEY (`pelajaran_id`);

--
-- Indeks untuk tabel `t_pertemuan`
--
ALTER TABLE `t_pertemuan`
  ADD PRIMARY KEY (`pertemuan_id`);

--
-- Indeks untuk tabel `t_peta`
--
ALTER TABLE `t_peta`
  ADD PRIMARY KEY (`peta_id`);

--
-- Indeks untuk tabel `t_pilihan_hasil`
--
ALTER TABLE `t_pilihan_hasil`
  ADD PRIMARY KEY (`pilihan_hasil_id`);

--
-- Indeks untuk tabel `t_post_hasil`
--
ALTER TABLE `t_post_hasil`
  ADD PRIMARY KEY (`post_hasil_id`);

--
-- Indeks untuk tabel `t_pre_hasil`
--
ALTER TABLE `t_pre_hasil`
  ADD PRIMARY KEY (`pre_hasil_id`);

--
-- Indeks untuk tabel `t_rencana`
--
ALTER TABLE `t_rencana`
  ADD PRIMARY KEY (`rencana_id`);

--
-- Indeks untuk tabel `t_semester`
--
ALTER TABLE `t_semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indeks untuk tabel `t_tujuan`
--
ALTER TABLE `t_tujuan`
  ADD PRIMARY KEY (`tujuan_id`);

--
-- Indeks untuk tabel `t_ujian_essay_hasil`
--
ALTER TABLE `t_ujian_essay_hasil`
  ADD PRIMARY KEY (`ujian_essay_hasil_id`);

--
-- Indeks untuk tabel `t_ujian_pilihan_hasil`
--
ALTER TABLE `t_ujian_pilihan_hasil`
  ADD PRIMARY KEY (`ujian_pilihan_hasil_id`);

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
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `t_assigment`
--
ALTER TABLE `t_assigment`
  MODIFY `assigment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `t_assigment_hasil`
--
ALTER TABLE `t_assigment_hasil`
  MODIFY `assigment_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `t_chat`
--
ALTER TABLE `t_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT untuk tabel `t_collassion`
--
ALTER TABLE `t_collassion`
  MODIFY `collassion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_diskusi`
--
ALTER TABLE `t_diskusi`
  MODIFY `diskusi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT untuk tabel `t_formative_hasil`
--
ALTER TABLE `t_formative_hasil`
  MODIFY `formative_hasil_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_informasi`
--
ALTER TABLE `t_informasi`
  MODIFY `informasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `t_kelompok`
--
ALTER TABLE `t_kelompok`
  MODIFY `kelompok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `t_latihan_hasil`
--
ALTER TABLE `t_latihan_hasil`
  MODIFY `latihan_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `t_materi`
--
ALTER TABLE `t_materi`
  MODIFY `materi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `t_modul`
--
ALTER TABLE `t_modul`
  MODIFY `modul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_panduan`
--
ALTER TABLE `t_panduan`
  MODIFY `panduan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_pelajaran`
--
ALTER TABLE `t_pelajaran`
  MODIFY `pelajaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `t_pertemuan`
--
ALTER TABLE `t_pertemuan`
  MODIFY `pertemuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT untuk tabel `t_peta`
--
ALTER TABLE `t_peta`
  MODIFY `peta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_pilihan_hasil`
--
ALTER TABLE `t_pilihan_hasil`
  MODIFY `pilihan_hasil_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_post_hasil`
--
ALTER TABLE `t_post_hasil`
  MODIFY `post_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `t_pre_hasil`
--
ALTER TABLE `t_pre_hasil`
  MODIFY `pre_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT untuk tabel `t_rencana`
--
ALTER TABLE `t_rencana`
  MODIFY `rencana_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_semester`
--
ALTER TABLE `t_semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `t_tujuan`
--
ALTER TABLE `t_tujuan`
  MODIFY `tujuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_ujian_essay_hasil`
--
ALTER TABLE `t_ujian_essay_hasil`
  MODIFY `ujian_essay_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_ujian_pilihan_hasil`
--
ALTER TABLE `t_ujian_pilihan_hasil`
  MODIFY `ujian_pilihan_hasil_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `t_video`
--
ALTER TABLE `t_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
