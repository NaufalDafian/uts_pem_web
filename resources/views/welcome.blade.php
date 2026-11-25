<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UTS Pem Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-biodata {
            border: 0;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
            overflow: hidden;
            height: 100%;
        }

        .card-biodata img {
            height: 260px;
            width: 100%;
            object-fit: cover;
            object-position: top;
            background: #eef1f4;
        }

        .card-add {
            min-height: 440px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
            background: #fff;
        }

        .btn-add {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 0;
            color: #fff;
            font-size: 64px;
            line-height: 1;
            background: linear-gradient(135deg, #6cbf6c 0%, #8fd18f 45%, #5aae5a 55%, #6cbf6c 100%);
            box-shadow: 0 4px 12px rgba(60, 140, 60, .35);
            transition: transform .15s;
        }

        .btn-add:hover {
            transform: scale(1.06);
        }

        .desc {
            font-size: .9rem;
            color: #555;
            min-height: 90px;
        }

        footer {
            margin-top: 4rem;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid px-3">
            <a class="navbar-brand" href="#">UTS Pem Web</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Naufal Dafiansyah & M.Nazril Lukman</a></li>
                    <li class="nav-item"><a class="nav-link disabled" href="#">24010110241 24010110226</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <!-- ALERT -->
        <div id="alertBox"></div>

        <!-- GRID KARTU -->
        <div class="row g-4" id="grid">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card-add">
                    <button class="btn-add" id="btnAdd" aria-label="Tambah biodata">+</button>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="container pb-4">
        <ul class="nav justify-content-center pb-3 mb-3 border-bottom">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
        </ul>
        <p class="text-center text-body-secondary">© 2025 Dibuat Sejujurjurnya Oleh Team (Masukkan Nama ketua) dan
            (Masukkan Nama Anggota) Tanpa Mencotek dari Tim Lain</p>
    </footer>

    <!-- MODAL FORM (Tambah / Edit) -->
    <div class="modal fade" id="formModal" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" id="bioForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Biodata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="fId">
                    <div class="mb-3">
                        <label class="form-label" for="fNama">Nama</label>
                        <input type="text" class="form-control" id="fNama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fNim">NIM</label>
                        <input type="text" class="form-control" id="fNim" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fDesk">Deskripsi</label>
                        <textarea class="form-control" id="fDesk" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fFoto">Foto</label>
                        <input type="file" class="form-control" id="fFoto" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS -->
    <div class="modal fade" id="delModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body pt-4">Yakin mau menghapus biodata <strong id="delName"></strong>?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" id="btnConfirmDel">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Foto placeholder (SVG siluet) kalau belum upload foto
        const placeholder = 'data:image/svg+xml;utf8,' + encodeURIComponent(
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 260"><rect width="400" height="260" fill="#eef1f4"/>' +
            '<circle cx="200" cy="105" r="48" fill="#c5ccd3"/><path d="M90 260c0-62 49-100 110-100s110 38 110 100z" fill="#c5ccd3"/></svg>'
        );

        let data = [{
                id: 1,
                nama: 'Nama Anggota 1',
                nim: '12.11.0001',
                foto: '',
                deskripsi: 'dengan NIM 12.11.0001 merupakan ketua tim dengan tugas membuat front-end dan mengirimkannya ke grup'
            },
            {
                id: 2,
                nama: 'Nama Anggota 2',
                nim: '12.11.0002',
                foto: '',
                deskripsi: 'dengan NIM 12.11.0002 merupakan anggota tim dan mempunyai tugas mengerjakan back-end pada UTS ini'
            }
        ];
        let nextId = 3,
            deleteId = null,
            pendingFoto = null;

        const grid = document.getElementById('grid');
        const addCol = grid.firstElementChild;
        const formModal = new bootstrap.Modal('#formModal');
        const delModal = new bootstrap.Modal('#delModal');
        const esc = s => s.replace(/[&<>"']/g, c => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        } [c]));

        function render() {
            grid.querySelectorAll('.bio-col').forEach(e => e.remove());
            data.forEach(d => {
                const col = document.createElement('div');
                col.className = 'col-12 col-md-6 col-lg-4 bio-col';
                col.innerHTML = `
        <div class="card card-biodata">
          <img src="${d.foto || placeholder}" alt="${esc(d.nama)}">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-bold">${esc(d.nama)}</h5>
            <p class="desc">${esc(d.deskripsi)}</p>
            <div class="mt-auto pt-3 border-top">
              <button class="btn btn-sm btn-outline-primary me-1" data-act="edit" data-id="${d.id}">Edit</button>
              <button class="btn btn-sm btn-outline-danger" data-act="del" data-id="${d.id}">Hapus</button>
            </div>
          </div>
        </div>`;
                grid.appendChild(col);
            });
        }

        function showAlert(msg, type = 'success') {
            document.getElementById('alertBox').innerHTML =
                `<div class="alert alert-${type} alert-dismissible fade show" role="alert">${msg}
         <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`;
        }

        // Tambah
        document.getElementById('btnAdd').onclick = () => {
            document.getElementById('bioForm').reset();
            document.getElementById('fId').value = '';
            document.getElementById('modalTitle').textContent = 'Tambah Biodata';
            pendingFoto = null;
            formModal.show();
        };

        // Edit / Hapus (event delegation)
        grid.addEventListener('click', e => {
            const btn = e.target.closest('button[data-act]');
            if (!btn) return;
            const d = data.find(x => x.id == btn.dataset.id);
            if (btn.dataset.act === 'edit') {
                document.getElementById('fId').value = d.id;
                document.getElementById('fNama').value = d.nama;
                document.getElementById('fNim').value = d.nim;
                document.getElementById('fDesk').value = d.deskripsi;
                document.getElementById('fFoto').value = '';
                document.getElementById('modalTitle').textContent = 'Edit Biodata';
                pendingFoto = null;
                formModal.show();
            } else {
                deleteId = d.id;
                document.getElementById('delName').textContent = d.nama;
                delModal.show();
            }
        });

        // Baca file foto
        document.getElementById('fFoto').onchange = e => {
            const f = e.target.files[0];
            if (!f) {
                pendingFoto = null;
                return;
            }
            const r = new FileReader();
            r.onload = () => pendingFoto = r.result;
            r.readAsDataURL(f);
        };

        // Simpan
        document.getElementById('bioForm').onsubmit = e => {
            e.preventDefault();
            const id = document.getElementById('fId').value;
            const payload = {
                nama: document.getElementById('fNama').value.trim(),
                nim: document.getElementById('fNim').value.trim(),
                deskripsi: document.getElementById('fDesk').value.trim()
            };
            if (id) {
                const d = data.find(x => x.id == id);
                Object.assign(d, payload);
                if (pendingFoto) d.foto = pendingFoto;
                showAlert('Biodata berhasil diperbarui.');
            } else {
                data.push({
                    id: nextId++,
                    foto: pendingFoto || '',
                    ...payload
                });
                showAlert('Biodata berhasil ditambahkan.');
            }
            formModal.hide();
            render();
        };

        // Konfirmasi hapus
        document.getElementById('btnConfirmDel').onclick = () => {
            data = data.filter(x => x.id !== deleteId);
            delModal.hide();
            render();
            showAlert('Biodata berhasil dihapus.', 'danger');
        };

        render();
    </script>
</body>

</html>
