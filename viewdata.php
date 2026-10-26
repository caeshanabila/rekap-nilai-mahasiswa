<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Rekap Nilai Mahasiswa</title>

  <!--begin::Theme Init (prevents flash of incorrect theme on load, #6043)-->
  <script>
    (() => {
      'use strict';
      const root = document.documentElement;

      // Applications with their own theming opt out of AdminLTE's color mode
      // entirely, here as well as in the bundle.
      if (root.getAttribute('data-lte-color-mode') === 'off') {
        return;
      }

      const STORAGE_KEY = 'lte-theme';
      let stored = null;
      try {
        stored = localStorage.getItem(STORAGE_KEY);
      } catch {
        // localStorage may be unavailable (private mode, sandboxed iframe).
      }
      // Mirror the precedence in color-mode.ts: the visitor's stored choice
      // wins, then a theme this page declared itself, then the OS preference.
      const authored = root.getAttribute('data-bs-theme');
      let resolved = 'light';
      if (stored === 'dark' || stored === 'light') {
        resolved = stored;
      } else if (authored === 'dark' || authored === 'light') {
        resolved = authored;
      } else if (globalThis.matchMedia('(prefers-color-scheme: dark)').matches) {
        resolved = 'dark';
      }
      root.setAttribute('data-bs-theme', resolved);
      root.style.colorScheme = resolved;
      // Flag values computed here, so the bundle does not mistake them for a
      // theme the page declared and stop following the OS preference.
      if (resolved !== authored) {
        root.setAttribute('data-lte-theme-resolved', '');
      }
    })();
  </script>
  <!--end::Theme Init-->

  <!--begin::Accessibility Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <meta name="color-scheme" content="light dark" />
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
  <!--end::Accessibility Meta Tags-->

  <!--begin::Primary Meta Tags-->
  <meta name="title" content="AdminLTE 4 | Users" />
  <meta name="author" content="ColorlibHQ" />
  <meta name="description"
    content="AdminLTE is a free Bootstrap 5 admin dashboard template with almost 50 example pages, built with vanilla JS and designed with accessibility in mind." />
  <meta name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel" />
  <!--end::Primary Meta Tags-->

  <!--begin::Accessibility Features-->
  <!-- Skip links will be dynamically added by accessibility.js -->
  <meta name="supported-color-schemes" content="light dark" />
  <link rel="preload" href="./css/adminlte.css" as="style" />
  <!--end::Accessibility Features-->

  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
    onload="this.media = 'all'" />
  <!--end::Fonts-->

  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->

  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->

  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="./css/adminlte.css" />
  <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    <!--begin::Header-->
    <!--end::Header-->
    <!--begin::Sidebar-->

    <!--end::Sidebar-->
    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6">
              <h1 class="mb-0 fs-3">Rekap Nilai Mahasiswa</h1>
            </div>
            <div class="col-sm-6">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Nilai</li>
                </ol>
              </nav>
            </div>
          </div>
          <!--end::Row-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content Header-->
      <!--begin::App Content-->
      <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-12">
              <!--begin::Card-->
              <div class="card mb-4">
                <!--begin::Card Header-->
                <div class="card-header">
                  <div class="row g-2 align-items-center">
                    <div class="col-12 col-md-4">
                      <h3 class="card-title">Data Nilai Mahasiswa</h3>
                    </div>
                    <div class="col-12 col-md-8">
                      <div class="d-flex flex-wrap justify-content-md-end gap-2">
                        <div class="input-group input-group-sm w-auto">
                          <span class="input-group-text">
                            <i class="bi bi-search" aria-hidden="true"></i>
                          </span>
                          <?php
                          // Mengambil kata pencarian dari URL
                          $search = isset($_GET['search'])
                            ? trim($_GET['search'])
                            : '';
                          ?>
                          <input
                            type="search"
                            id="user-search"
                            class="form-control"
                            placeholder="Cari Berdasarkan Nama"
                            aria-label="Cari Data"
                            value="<?php echo $search; ?>"
                            style="width: 190px" />
                        </div>
                        <select id="user-role-filter" name="predikat" class="form-select form-select-sm w-auto"
                          aria-label="Filter by role">
                          <option value="all">Semua Predikat</option>
                          <option value="sangat memuaskan">Sangat Memuaskan</option>
                          <option value="memuaskan">Memuaskan</option>
                          <option value="cukup memuaskan">Cukup Memuaskan</option>
                          <option value="kurang memuaskan">Kurang Memuaskan</option>
                          <option value="tidak lulus">Tidak Lulus</option>
                        </select>
                        <select id="page-size" class="form-select form-select-sm w-auto"
                          aria-label="Jumlah data per halaman">
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="15">20</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                          data-bs-target="#modal-add-user">
                          <i class="bi bi-person-plus-fill me-1" aria-hidden="true"> </i>
                          Tambah Data Nilai
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!--end::Card Header-->
                <?php
                //koneksi ke db
                require_once __DIR__ . "/connection1.php";

                // Mengambil kata pencarian nama
                $search = isset($_GET['search'])
                  ? trim($_GET['search'])
                  : '';

                // Mengambil filter predikat
                $filter = isset($_GET['predikat'])
                  ? $_GET['predikat']
                  : 'all';

                // Mengambil pilihan sorting
                $sort_kolom = $_GET['sort_kolom'] ?? 'nilaiakhir';
                $sort_urutan = $_GET['sort_urutan'] ?? 'desc';

                // Kondisi filter predikat dan search nama
                $where = " WHERE 1=1";

                if ($filter != 'all' && !empty($filter)) {
                  $filter = mysqli_real_escape_string($conn, $filter);
                  $where .= " AND predikat = '$filter'";
                }

                // Mencari nama berdasarkan huruf awal
                if ($search !== '') {
                  $keyword = mysqli_real_escape_string($conn, $search);
                  $where .= " AND namalengkap LIKE '$keyword%'";
                }
                // Menentukan kolom yang boleh diurutkan
                if ($sort_kolom == 'nim') {
                  $kolom = 'nim';
                } elseif ($sort_kolom == 'namalengkap') {
                  $kolom = 'namalengkap';
                } else {
                  $kolom = 'nilaiakhir';
                }

                // Menentukan arah pengurutan
                $urutan = ($sort_urutan == 'asc') ? 'ASC' : 'DESC';


                // Mengambil jumlah data per halaman
                $limit = isset($_GET['page_size']) ? (int) $_GET['page_size'] : 5;

                // Membatasi pilihan Page Size
                if (!in_array($limit, [5, 10, 15, 20])) {
                  $limit = 5;
                }

                // Mengambil nomor halaman
                $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;

                // Menghitung total data sesuai filter dan pencarian
                $hitung = mysqli_query(
                  $conn,
                  "SELECT COUNT(*) AS total FROM nilaimhsw" . $where
                );

                $total_data = (int) mysqli_fetch_assoc($hitung)['total'];

                // Menghitung jumlah halaman
                $total_page = max(1, (int) ceil($total_data / $limit));

                if ($page > $total_page) {
                  $page = $total_page;
                }

                // Menghitung posisi data
                $offset = ($page - 1) * $limit;
                $dari = ($total_data > 0) ? $offset + 1 : 0;
                $sampai = min($offset + $limit, $total_data);

                // Query data dengan sorting dan pagination
                $sql = "SELECT * FROM nilaimhsw" . $where;
                $sql .= " ORDER BY $kolom $urutan";
                $sql .= " LIMIT $limit OFFSET $offset";

                $result = mysqli_query($conn, $sql);

                // Menyiapkan parameter URL untuk navigasi halaman
                $params = $_GET;
                unset($params['page']);
                $params['page_size'] = $limit;
                $query = http_build_query($params);

                // Process the result set
                if (mysqli_num_rows($result) > 0) {
                ?>
                  <!--begin::Card Body-->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover align-middle m-0">

                        <thead>
                          <tr>
                            <th>
                              <?php
                              $next_sort = ($sort_kolom == 'nim' && $sort_urutan == 'asc') ? 'desc' : 'asc';
                              $icon_class = ($sort_kolom == 'nim')
                                ? (($sort_urutan == 'asc') ? 'bi-arrow-up' : 'bi-arrow-down')
                                : 'bi-arrow-down-up';
                              ?>
                              <button type="button" class="btn btn-sm text-reset fw-bold p-0 border-0 shadow-none btn-sort"
                                data-kolom="nim" data-sort="<?php echo $next_sort; ?>">
                                NIM <i class="bi <?php echo $icon_class; ?> ms-1"></i>
                              </button>
                            </th>
                            <th>
                              <?php
                              $next_sort = ($sort_kolom == 'namalengkap' && $sort_urutan == 'asc') ? 'desc' : 'asc';
                              $icon_class = ($sort_kolom == 'namalengkap')
                                ? (($sort_urutan == 'asc') ? 'bi-arrow-up' : 'bi-arrow-down')
                                : 'bi-arrow-down-up';
                              ?>
                              <button type="button" class="btn btn-sm text-reset fw-bold p-0 border-0 shadow-none btn-sort"
                                data-kolom="namalengkap" data-sort="<?php echo $next_sort; ?>">
                                Nama Lengkap <i class="bi <?php echo $icon_class; ?> ms-1"></i>
                              </button>
                            </th>
                            <th>
                              <?php
                              $next_sort = ($sort_kolom == 'nilaiakhir' && $sort_urutan == 'asc') ? 'desc' : 'asc';
                              $icon_class = ($sort_kolom == 'nilaiakhir')
                                ? (($sort_urutan == 'asc') ? 'bi-arrow-up' : 'bi-arrow-down')
                                : 'bi-arrow-down-up';
                              ?>
                              <button type="button" class="btn btn-sm text-reset fw-bold p-0 border-0 shadow-none btn-sort"
                                data-kolom="nilaiakhir" data-sort="<?php echo $next_sort; ?>">
                                Nilai Akhir <i class="bi <?php echo $icon_class; ?> ms-1"></i>
                              </button>
                            </th>
                            <th>Nilai Huruf</th>
                            <th>Predikat</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Diubah</th>
                            <th class="text-end">Aksi</th>
                          </tr>
                        </thead>

                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <tbody>
                            <tr>
                              <td>
                                <!-- <div class="d-flex align-items-center">
                              <img src="./assets/img/user1-128x128.jpg" alt=""
                                class="img-size-32 rounded-circle me-2" /> -->
                                <span class="fw-medium"><?php echo $row['nim']; ?></span>
                                <!-- </div> -->
                              </td>

                              <td>
                                <div class="d-flex align-items-center">
                                  <?php

                                  // Mengambil foto mahasiswa dari database
                                  $foto = !empty($row['foto'])
                                    ? $row['foto']
                                    : 'defaultphoto.jpg';
                                  ?>
                                  <img
                                    src="./img/<?php echo $foto; ?>"
                                    class="rounded-circle me-2"
                                    width="48"
                                    height="48"
                                    style="object-fit: cover;"
                                    alt="Foto Mahasiswa">
                                  <span class="fw-medium">
                                    <?php echo ($row['namalengkap']); ?>
                                  </span>
                                </div>
                              </td>

                              <td>
                                <span class="fw-medium"><?php echo $row['nilaiakhir']; ?></span>
                              </td>
                              <td>
                                <span class="fw-medium"><?php echo $row['nilaihuruf']; ?></span>
                              </td>
                              <td>
                                <span class="fw-medium"><?php echo $row['predikat']; ?></span>
                              </td>
                              <td>
                                <span class="fw-medium"><?php echo $row['created_date']; ?></span>
                              </td>
                              <td>
                                <span class="fw-medium"><?php echo $row['modified_date']; ?></span>
                              </td>
                              <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                  <button type="button"
                                    class="btn btn-outline-secondary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-edit-user"
                                    data-nim="<?php echo $row['nim']; ?>"
                                    data-nama="<?php echo $row['namalengkap']; ?>"
                                    data-nilai="<?php echo $row['nilaiakhir']; ?>"
                                    aria-label="Edit Data Mahasiswa">
                                    <i class="bi bi-pencil"></i>
                                  </button>

                                  <button type="button"
                                    class="btn btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-delete-user"
                                    data-nim="<?php echo $row['nim']; ?>"
                                    data-nama="<?php echo $row['namalengkap']; ?>"
                                    aria-label="Hapus Data Mahasiswa">
                                    <i class="bi bi-trash"></i>
                                  </button>

                                </div>
                              </td>
                            </tr>

                          </tbody>
                        <?php } ?>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  <?php
                } else {
                  echo "0 results - Data not found!";
                }
                mysqli_close($conn);
                  ?>

                  </div>
                  <!--end::Card Body-->
                  <!--begin::Card Footer-->
                  <div class="card-footer clearfix">
                    <div class="float-start pt-1 fs-7 text-body-secondary">
                      Menampilkan <?php echo $dari; ?> - <?php echo $sampai; ?>
                      dari <?php echo $total_data; ?> data mahasiswa
                    </div>
                    <ul class="pagination pagination-sm m-0 float-end">
                      <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link"
                          href="?<?php echo htmlspecialchars(http_build_query(array_merge($params, ['page' => max(1, $page - 1)]))); ?>">
                          &laquo;
                        </a>
                      </li>

                      <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                          <a class="page-link"
                            href="?<?php echo htmlspecialchars(http_build_query(array_merge($params, ['page' => $i]))); ?>">
                            <?php echo $i; ?>
                          </a>
                        </li>
                      <?php } ?>

                      <li class="page-item <?php echo ($page >= $total_page) ? 'disabled' : ''; ?>">
                        <a class="page-link"
                          href="?<?php echo htmlspecialchars(http_build_query(array_merge($params, ['page' => min($total_page, $page + 1)]))); ?>">
                          &raquo;
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!--end::Card Footer-->
              </div>
              <!--end::Card-->
            </div>
            <!-- /.col -->
          </div>
          <!--end::Row-->

          <!--begin::Add User Modal-->
          <div class="modal fade" id="modal-add-user" tabindex="-1" aria-labelledby="modal-add-user-label"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="insertdata1.php" method="post" enctype="multipart/form-data">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-add-user-label">Add new user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="new-nim" class="form-label"> NIM * </label><br />
                      <input type="text" minlength=10 maxlength=10 placeholder="cth. 320xx16xxx" name="nim" required />
                    </div>
                    <div class="mb-3">
                      <label for="new-namalengkap" class="form-label"> Nama Lengkap </label>
                      <input type="text" class="form-control" id="new-user-name" placeholder="cth. Caesha" name="namalengkap" required />
                    </div>
                    <div class="mb-3">
                      <label for="new-nilaiakhir" class="form-label"> Nilai Akhir </label>
                      <input type="number" class="form-control" id="new-user-email" placeholder="xxx.xx" name="nilaiakhir" min=0 max=100 step=0.01
                        required />
                    </div>
                    <div class="mb-3">
                      <label for="foto" class="form-label">Foto Mahasiswa</label>
                      <input
                        type="file"
                        class="form-control"
                        id="foto"
                        name="foto"
                        accept="image/*" />
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">Create user</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--end::Add User Modal-->

          <!-- Modal Edit Data Nilai -->
          <div class="modal fade" id="modal-edit-user" tabindex="-1"
            aria-labelledby="modal-edit-user-label" aria-hidden="true">

            <div class="modal-dialog">
              <div class="modal-content">
                <form action="editdata1.php" method="POST" enctype="multipart/form-data">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-edit-user-label">
                      Edit Data Nilai Mahasiswa
                    </h5>
                    <button type="button" class="btn-close"
                      data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">

                    <div class="mb-3">
                      <label for="edit-nim" class="form-label">NIM</label>

                      <input type="text"
                        class="form-control"
                        id="edit-nim"
                        name="nim_baru"
                        minlength="10"
                        maxlength="10"
                        required>

                      <input type="hidden"
                        id="edit-nim-lama"
                        name="nim_lama">
                    </div>

                    <div class="mb-3">
                      <label for="edit-namalengkap" class="form-label">
                        Nama Lengkap
                      </label>
                      <input type="text" class="form-control"
                        id="edit-namalengkap" name="namalengkap"
                        required>
                    </div>

                    <div class="mb-3">
                      <label for="edit-nilaiakhir" class="form-label">
                        Nilai Akhir
                      </label>
                      <input type="number" class="form-control"
                        id="edit-nilaiakhir" name="nilaiakhir"
                        min="0" max="100" step="0.01" required>
                    </div>

                    <div class="mb-3">
                      <label for="edit-foto" class="form-label">Foto Mahasiswa</label>
                      <input
                        type="file"
                        class="form-control"
                        id="edit-foto"
                        name="foto"
                        accept="image/*">
                    </div>

                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                      data-bs-dismiss="modal">
                      Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                      <i class="bi bi-save me-1"></i>
                      Simpan Perubahan
                    </button>
                  </div>

                </form>

              </div>
            </div>
          </div>
          <!-- Akhir Modal Edit Data Nilai -->

          <!--begin::Delete User Modal-->
          <div class="modal fade" id="modal-delete-user" tabindex="-1" aria-labelledby="modal-delete-user-label"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="deletedata.php" method="POST">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-delete-user-label">Hapus data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p class="mb-0">
                      Apakah kamu yakin ingin menghapus data mahasiswa ini?
                    </p>
                    <p>
                      NIM: <strong id="delete-nim-text"></strong><br>
                      Nama: <strong id="delete-nama-text"></strong>
                    </p>
                    <input type="hidden" name="nim" id="delete-nim">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                      Hapus data
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--end::Delete User Modal-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content-->
    </main>
    <!--end::App Main-->
    <!--begin::Footer-->
    <footer class="app-footer">
      <!--begin::To the end-->
      <div class="float-end d-none d-sm-inline">Web Programming Semester 5</div>
      <!--end::To the end-->
      <!--begin::Copyright-->
      <strong>
        Copyright &copy; 2026&nbsp;
        <a href="https://adminlte.io" class="text-decoration-none">Caesha Nabila</a>.
      </strong>
      <!--end::Copyright-->
    </footer>
    <!--end::Footer-->
  </div>
  <!--end::App Wrapper-->
  <!--begin::Script-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="./js/adminlte.js"></script>
  <!--end::Required Plugin(AdminLTE)-->
  <!--begin::OverlayScrollbars Configure-->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

      // Disable OverlayScrollbars on mobile devices to prevent touch interference
      const isMobile = window.innerWidth <= 992;

      if (
        sidebarWrapper &&
        OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
        !isMobile
      ) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
      // Page Size
      const pageSize = document.getElementById('page-size');
      const paramsPage = new URLSearchParams(window.location.search);

      if (pageSize) {
        pageSize.value = paramsPage.get('page_size') || '5';

        pageSize.addEventListener('change', function() {
          const params = new URLSearchParams(window.location.search);
          params.set('page_size', this.value);
          params.delete('page');

          window.location.href =
            window.location.pathname + '?' + params.toString();
        });
      }
    });
  </script>
  <!--end::OverlayScrollbars Configure-->

  <!--begin::Color Mode Toggle-->
  <!-- The light/dark/auto switcher ships in adminlte.js as the ColorMode
     module (since 4.1) — no page script needed. Only the no-flash snippet
     in <head> stays inline, because it must run before first paint. -->
  <!--end::Color Mode Toggle-->

  <!--end::Script-->

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // hapus 
      const deleteModal = document.getElementById('modal-delete-user');

      if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
          const tombol = event.relatedTarget;

          document.getElementById('delete-nim').value =
            tombol.getAttribute('data-nim');

          document.getElementById('delete-nim-text').textContent =
            tombol.getAttribute('data-nim');

          document.getElementById('delete-nama-text').textContent =
            tombol.getAttribute('data-nama');
        });
      }

      // edit 
      const editModal = document.getElementById('modal-edit-user');

      if (editModal) {
        editModal.addEventListener('show.bs.modal', function(event) {
          const tombol = event.relatedTarget;
          const nimLama = tombol.getAttribute('data-nim');

          document.getElementById('edit-nim').value = nimLama;

          document.getElementById('edit-nim-lama').value = nimLama;

          document.getElementById('edit-namalengkap').value =
            tombol.getAttribute('data-nama');

          document.getElementById('edit-nilaiakhir').value =
            tombol.getAttribute('data-nilai');
        });
      }


      //search nama
      const searchInput = document.getElementById('user-search');


      if (searchInput) {
        // Mencari nama berdasarkan huruf awal
        searchInput.addEventListener('input', function() {
          const keyword = this.value.toLowerCase().trim();
          const rows = document.querySelectorAll('table tbody tr');

          rows.forEach(function(row) {
            const nama = row.cells[1].textContent.trim().toLowerCase();

            row.style.display = nama.startsWith(keyword) ? '' : 'none';
          });
        });

        // Mencegah halaman dimuat ulang saat Enter
        searchInput.addEventListener('keydown', function(event) {
          if (event.key === 'Enter') {
            event.preventDefault();
          }
        });
      }

      // Filter predikat
      const filterDropdown = document.getElementById('user-role-filter');

      if (filterDropdown) {
        // Menyesuaikan dropdown dengan filter pada URL
        const urlParams = new URLSearchParams(window.location.search);
        filterDropdown.value = urlParams.get('predikat') || 'all';

        filterDropdown.addEventListener('change', function() {
          const urlParams = new URLSearchParams(window.location.search);

          // Menghapus filter jika semua predikat dipilih
          if (this.value === 'all') {
            urlParams.delete('predikat');
          } else {
            urlParams.set('predikat', this.value);
          }

          // Kembali ke halaman pertama
          urlParams.delete('page');

          // Memuat hasil filter
          const query = urlParams.toString();
          window.location.href = window.location.pathname + (query ? '?' + query : '');
        });
      }


      // Sorting data dengan tombol panah
      const tombolSort = document.querySelectorAll('.btn-sort');

      tombolSort.forEach(function(tombol) {
        tombol.addEventListener('click', function() {
          const params = new URLSearchParams(window.location.search);

          params.set('sort_kolom', this.getAttribute('data-kolom'));
          params.set('sort_urutan', this.getAttribute('data-sort'));
          params.delete('page');

          window.location.href = window.location.pathname + '?' + params.toString();
        });
      });

    });
  </script>
</body>
<!--end::Body-->

</html>