
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#080e1c">
<title>PENDEKIN AJA — URL Shortener</title>

<link rel="shortcut icon" href="https://icons.iconarchive.com/icons/rokey/the-last-order-candy/128/internet-icon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
:root {
    --bg: #080e1c;
    --panel: rgba(17, 29, 51, .78);
    --panel2: #111d33;
    --border: rgba(148, 170, 205, .13);
    --text: #edf4ff;
    --muted: #8798b4;
    --blue: #438cff;
    --cyan: #36d5e9;
    --green: #32d69b;
    --red: #ff6179;
    --radius: 20px;
    --shadow: 0 20px 60px rgba(0,0,0,.22);
}

* { box-sizing: border-box; }

body {
    margin: 0;
    min-height: 100vh;
    font-family: 'DM Sans', sans-serif;
    color: var(--text);
    background:
        radial-gradient(ellipse at 12% 5%, rgba(39,111,255,.17), transparent 35%),
        radial-gradient(ellipse at 90% 25%, rgba(28,206,226,.10), transparent 32%),
        var(--bg);
    overflow-x: hidden;
}

body::before {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;
    opacity: .13;
    background-image: radial-gradient(rgba(255,255,255,.3) .6px, transparent .6px);
    background-size: 24px 24px;
    mask-image: linear-gradient(to bottom, black, transparent 75%);
}

button, input { font: inherit; }
button { cursor: pointer; }

.container {
    width: min(1180px, calc(100% - 40px));
    margin: auto;
    position: relative;
    z-index: 1;
}

/* HEADER */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 25px 0;
    border-bottom: 1px solid var(--border);
}

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
}

.brand-icon {
    width: 44px;
    height: 44px;
    display: grid;
    place-items: center;
    border-radius: 14px;
    color: white;
    font-size: 22px;
    background: linear-gradient(135deg, var(--blue), var(--cyan));
    box-shadow: 0 7px 25px rgba(54,145,255,.3);
}

.brand-name {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 19px;
    font-weight: 700;
    letter-spacing: .4px;
}

.brand-name span { color: var(--cyan); }

.status {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: var(--muted);
    padding: 8px 13px;
    border: 1px solid var(--border);
    border-radius: 30px;
    background: rgba(255,255,255,.025);
}

.status-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--green);
    box-shadow: 0 0 12px var(--green);
}

/* HERO */
.hero {
    text-align: center;
    padding: 65px 0 35px;
}

.eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border: 1px solid rgba(54,213,233,.2);
    background: rgba(54,213,233,.06);
    border-radius: 30px;
    color: var(--cyan);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.hero h1 {
    font-family: 'Space Grotesk', sans-serif;
    font-size: clamp(36px, 6vw, 62px);
    line-height: 1.08;
    margin: 22px 0 14px;
    letter-spacing: -2px;
}

.gradient-text {
    background: linear-gradient(100deg, #66a4ff, #39d9e9);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.hero p {
    color: var(--muted);
    font-size: 15px;
    margin: 0;
    line-height: 1.8;
}

/* SHORTENER */
.shortener {
    max-width: 850px;
    margin: 15px auto 30px;
    padding: 26px;
    background: var(--panel);
    backdrop-filter: blur(18px);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
}

.section-label {
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 14px;
    display: flex;
    gap: 9px;
    align-items: center;
}

.section-label i { color: var(--cyan); font-size: 17px; }

.input-group {
    display: flex;
    gap: 10px;
}

.input-wrap {
    position: relative;
    flex: 1;
    min-width: 0;
}

.input-wrap i {
    position: absolute;
    top: 50%;
    left: 17px;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: 17px;
}

.input-wrap input {
    width: 100%;
    height: 54px;
    border: 1px solid var(--border);
    background: rgba(5,12,25,.65);
    color: var(--text);
    border-radius: 12px;
    padding: 0 15px 0 46px;
    outline: none;
    transition: .2s;
}

input::placeholder { color: #65748d; }

.input-wrap input:focus,
.search-wrap input:focus,
.modal-input:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(67,140,255,.12);
}

.btn-primary {
    border: 0;
    border-radius: 12px;
    color: white;
    font-weight: 700;
    padding: 0 23px;
    height: 54px;
    background: linear-gradient(110deg, #397cf5, #27b9dc);
    box-shadow: 0 7px 22px rgba(48,137,255,.2);
    transition: .2s;
    white-space: nowrap;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(48,137,255,.35);
}

.btn-primary:disabled { opacity: .6; cursor: wait; transform: none; }

.helper {
    margin-top: 13px;
    color: var(--muted);
    font-size: 11px;
}

/* STATISTICS */
.stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin: 30px 0;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px;
    border: 1px solid var(--border);
    background: var(--panel);
    border-radius: 17px;
    backdrop-filter: blur(12px);
    transition: .25s;
}

.stat-card:hover {
    transform: translateY(-4px);
    border-color: rgba(67,140,255,.35);
}

.stat-icon {
    width: 46px;
    height: 46px;
    display: grid;
    place-items: center;
    border-radius: 13px;
    font-size: 20px;
    background: rgba(67,140,255,.13);
    color: #69a4ff;
}

.stat-icon.cyan { background: rgba(54,213,233,.1); color: var(--cyan); }
.stat-icon.green { background: rgba(50,214,155,.1); color: var(--green); }

.stat-label { color: var(--muted); font-size: 12px; }
.stat-value {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 25px;
    font-weight: 700;
    margin-top: 3px;
}

/* TABLE PANEL */
.table-panel {
    padding: 24px;
    border: 1px solid var(--border);
    background: var(--panel);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    backdrop-filter: blur(18px);
    margin-bottom: 35px;
}

.table-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 18px;
    margin-bottom: 22px;
}

.table-heading h2 {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 19px;
    margin: 0;
}

.table-heading p {
    color: var(--muted);
    font-size: 11px;
    margin: 6px 0 0;
}

.search-wrap {
    position: relative;
    width: min(280px, 100%);
}

.search-wrap i {
    position: absolute;
    top: 50%;
    left: 13px;
    transform: translateY(-50%);
    color: var(--muted);
}

.search-wrap input {
    width: 100%;
    height: 42px;
    border: 1px solid var(--border);
    background: rgba(5,12,25,.65);
    color: white;
    padding: 0 12px 0 38px;
    border-radius: 10px;
    outline: none;
    font-size: 12px;
}

.table-responsive { overflow-x: auto; }

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 760px;
}

thead th {
    padding: 14px 12px;
    color: #8295b4;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: .8px;
    text-align: left;
    border-bottom: 1px solid var(--border);
    white-space: nowrap;
}

tbody td {
    padding: 15px 12px;
    font-size: 12px;
    color: #dce7f8;
    border-bottom: 1px solid rgba(148,170,205,.08);
    vertical-align: middle;
}

tbody tr { transition: .2s; }
tbody tr:hover { background: rgba(67,140,255,.045); }
tbody tr:last-child td { border-bottom: 0; }

.number { color: var(--muted); }

.short-link {
    color: #70aaff;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
}

.short-link:hover { color: var(--cyan); }

.original-link {
    display: inline-block;
    max-width: 220px;
    color: #8b9ab2;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    vertical-align: middle;
}

.view-more {
    display: inline-block;
    margin-left: 5px;
    color: var(--cyan);
    text-decoration: none;
    font-size: 10px;
    white-space: nowrap;
}

.url-title {
    display: inline-block;
    max-width: 180px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.date-text { color: var(--muted); white-space: nowrap; font-size: 11px; }

.actions { display: flex; gap: 6px; }

.action-btn {
    width: 32px;
    height: 32px;
    display: grid;
    place-items: center;
    border: 1px solid var(--border);
    background: rgba(255,255,255,.035);
    color: #aabbd4;
    border-radius: 8px;
    transition: .2s;
}

.action-btn:hover { transform: translateY(-2px); }
.action-btn.edit:hover { color: var(--blue); border-color: var(--blue); }
.action-btn.delete:hover { color: var(--red); border-color: var(--red); }
.action-btn.copy:hover { color: var(--cyan); border-color: var(--cyan); }

.empty-state {
    padding: 45px 15px;
    text-align: center;
    color: var(--muted);
}

.empty-state i { font-size: 32px; display: block; margin-bottom: 12px; color: #54739e; }
.empty-state strong { color: var(--text); display: block; margin-bottom: 5px; }

/* PAGINATION */
.pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    margin-top: 23px;
    flex-wrap: wrap;
}

.page-btn {
    min-width: 35px;
    height: 35px;
    border: 1px solid var(--border);
    border-radius: 9px;
    background: rgba(255,255,255,.035);
    color: #a9bad3;
    font-size: 11px;
    transition: .2s;
}

.page-btn:hover, .page-btn.active {
    color: white;
    border-color: var(--blue);
    background: rgba(67,140,255,.2);
}

.page-btn:disabled { opacity: .3; cursor: not-allowed; }

/* MODAL */
.modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 20;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(2,7,17,.8);
    backdrop-filter: blur(8px);
}

.modal-overlay.show { display: flex; }

.modal-box {
    width: min(460px, 100%);
    padding: 26px;
    background: #111d33;
    border: 1px solid var(--border);
    border-radius: 19px;
    box-shadow: 0 25px 80px rgba(0,0,0,.45);
    animation: modalIn .22s ease;
}

@keyframes modalIn {
    from { opacity: 0; transform: translateY(12px) scale(.98); }
    to { opacity: 1; transform: none; }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 23px;
}

.modal-header h3 { font-size: 18px; margin: 0; }

.close-modal {
    width: 32px;
    height: 32px;
    border: 0;
    border-radius: 9px;
    color: var(--muted);
    background: rgba(255,255,255,.06);
    font-size: 18px;
}

.field { margin-bottom: 17px; }
.field label {
    display: block;
    font-size: 11px;
    color: #a8b9d2;
    margin-bottom: 8px;
}

.modal-input {
    width: 100%;
    height: 45px;
    background: rgba(5,12,25,.65);
    border: 1px solid var(--border);
    border-radius: 9px;
    padding: 0 13px;
    color: white;
    outline: none;
    font-size: 12px;
}

.save-btn { width: 100%; margin-top: 5px; }

/* TOAST */
.toast {
    position: fixed;
    z-index: 50;
    right: 25px;
    bottom: 25px;
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 15px 19px;
    background: #152740;
    border: 1px solid var(--border);
    border-radius: 12px;
    color: white;
    font-size: 12px;
    box-shadow: var(--shadow);
    opacity: 0;
    transform: translateY(15px);
    pointer-events: none;
    transition: .25s;
    max-width: calc(100% - 40px);
}

.toast.show { opacity: 1; transform: translateY(0); }
.toast i { color: var(--green); font-size: 17px; }
.toast.error i { color: var(--red); }

/* LOADING */
.loading-row td { text-align: center; padding: 35px; color: var(--muted); }
.spinner {
    display: inline-block;
    width: 18px;
    height: 18px;
    border: 2px solid rgba(255,255,255,.15);
    border-top-color: var(--cyan);
    border-radius: 50%;
    animation: spin .7s linear infinite;
    vertical-align: middle;
    margin-right: 8px;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* FOOTER */
footer {
    text-align: center;
    padding: 10px 0 30px;
    color: #64758e;
    font-size: 11px;
}
footer a { color: #79aaff; text-decoration: none; font-weight: 700; }

/* RESPONSIVE */
@media(max-width: 700px) {
    .container { width: min(100% - 26px, 1180px); }
    .topbar { padding: 17px 0; }
    .brand-name { font-size: 16px; }
    .brand-icon { width: 39px; height: 39px; }
    .status { font-size: 10px; padding: 7px 9px; }
    .hero { padding: 48px 0 25px; }
    .hero h1 { letter-spacing: -1.5px; }
    .hero p { font-size: 13px; }
    .shortener { padding: 19px; margin-top: 10px; }
    .input-group { flex-direction: column; }
    .btn-primary { width: 100%; }
    .stats { gap: 9px; margin: 22px 0; }
    .stat-card { padding: 13px 10px; gap: 9px; flex-direction: column; align-items: flex-start; }
    .stat-icon { width: 35px; height: 35px; font-size: 16px; }
    .stat-value { font-size: 20px; }
    .stat-label { font-size: 10px; }
    .table-panel { padding: 16px 12px; }
    .table-heading { flex-direction: column; align-items: stretch; }
    .search-wrap { width: 100%; }
    .toast { right: 13px; bottom: 13px; }
}

@media(prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: .01ms !important;
        transition-duration: .01ms !important;
        scroll-behavior: auto !important;
    }
}
</style>
</head>

<body>

<div class="container">

    <header class="topbar">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-link-45deg"></i></div>
            <div class="brand-name">PENDEKIN <span>AJA.</span></div>
        </div>
        <div class="status">
            <span class="status-dot"></span>
            URL SERVICE
        </div>
    </header>

    <section class="hero">
        <div class="eyebrow"><i class="bi bi-lightning-charge-fill"></i> SIMPLE. FAST. SMART.</div>       
    </section>

    <section class="shortener">
        <div class="section-label">
            <i class="bi bi-magic"></i>
            Buat Short URL Baru
        </div>

        <form id="shorten-form">
            <div class="input-group">
                <div class="input-wrap">
                    <i class="bi bi-link-45deg"></i>
                    <input type="url" id="original_url"
                           placeholder="https://contoh.com/tautan-panjang..."
                           required autocomplete="url">
                </div>
                <button type="submit" class="btn-primary" id="generate-btn">
                    <i class="bi bi-lightning-charge-fill"></i>
                    Generate URL
                </button>
            </div>
        </form>
        <div class="helper">
            <i class="bi bi-shield-check"></i>
            Masukkan alamat URL lengkap yang diawali http:// atau https://
        </div>
    </section>

    <section class="stats">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-link-45deg"></i></div>
            <div>
                <div class="stat-label">Total URL</div>
                <div class="stat-value" id="total-urls">—</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon cyan"><i class="bi bi-layers"></i></div>
            <div>
                <div class="stat-label">URL Ditampilkan</div>
                <div class="stat-value" id="shown-urls">0</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-activity"></i></div>
            <div>
                <div class="stat-label">Status Layanan</div>
                <div class="stat-value" style="font-size:17px;color:var(--green)">Active</div>
            </div>
        </div>
    </section>

    <section class="table-panel">
        <div class="table-heading">
            <div>
                <h2><i class="bi bi-collection" style="color:var(--cyan)"></i> URL Management</h2>
                <p>Kelola, edit, salin, dan hapus tautan Anda.</p>
            </div>

            <div class="search-wrap">
                <i class="bi bi-search"></i>
                <input type="search" id="search_query" placeholder="Cari URL atau judul...">
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Short URL</th>
                        <th>Original URL</th>
                        <th>Title</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="url-list">
                    <tr class="loading-row">
                        <td colspan="6"><span class="spinner"></span> Memuat data URL...</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination" id="pagination"></div>
    </section>

    <footer>
        © <span id="year"></span> Made with <i class="bi bi-heart-fill" style="color:var(--red)"></i>
        by <a href="https://galih-os.github.io/" target="_blank" rel="noopener noreferrer">Galih-OS.</a>
        All rights reserved.
    </footer>

</div>

<!-- EDIT MODAL -->
<div class="modal-overlay" id="editModal" role="dialog" aria-modal="true" aria-labelledby="editModalLabel">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="editModalLabel"><i class="bi bi-pencil-square" style="color:var(--cyan)"></i> Edit Short URL</h3>
            <button type="button" class="close-modal" id="close-modal" aria-label="Tutup">&times;</button>
        </div>

        <form id="edit-form">
            <input type="hidden" id="edit-id">

            <div class="field">
                <label for="edit-original_url">Original URL</label>
                <input type="url" class="modal-input" id="edit-original_url" required>
            </div>

            <div class="field">
                <label for="edit-short_code">Short Code</label>
                <input type="text" class="modal-input" id="edit-short_code" required>
            </div>

            <div class="field">
                <label for="edit-title">Title</label>
                <input type="text" class="modal-input" id="edit-title" required>
            </div>

            <button type="submit" class="btn-primary save-btn" id="save-btn">
                <i class="bi bi-check-circle"></i> Save Changes
            </button>
        </form>
    </div>
</div>

<!-- NOTIFICATION -->
<div class="toast" id="toast" role="status" aria-live="polite">
    <i class="bi bi-check-circle-fill"></i>
    <span id="toast-message">Berhasil!</span>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const $ = id => document.getElementById(id);

    let currentPage = 1;
    const perPage = 5;
    let searchTimer = null;
    let toastTimer = null;
    let requestController = null;

    $('year').textContent = new Date().getFullYear();

    // Escape HTML agar data database tidak dieksekusi sebagai HTML.
    function escapeHTML(value) {
        return String(value ?? '').replace(/[&<>"']/g, char => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        })[char]);
    }

    function safeURL(value) {
        try {
            const url = new URL(value);
            return ['http:', 'https:'].includes(url.protocol) ? url.href : '#';
        } catch {
            return '#';
        }
    }

    function notify(message, error = false) {
        const toast = $('toast');
        toast.classList.toggle('error', error);
        toast.querySelector('i').className = error
            ? 'bi bi-exclamation-circle-fill'
            : 'bi bi-check-circle-fill';

        $('toast-message').textContent = message;
        toast.classList.add('show');

        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toast.classList.remove('show'), 3000);
    }

    async function requestJSON(url, options = {}) {
        const response = await fetch(url, {
            ...options,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                ...options.headers
            }
        });

        if (!response.ok) {
            throw new Error(`Server error (${response.status})`);
        }

        return await response.json();
    }

    function setLoading(message = 'Memuat data URL...') {
        $('url-list').innerHTML = `
            <tr class="loading-row">
                <td colspan="6"><span class="spinner"></span>${escapeHTML(message)}</td>
            </tr>`;
    }

    function renderEmpty(message, description = 'Belum ada data yang tersedia.') {
        $('url-list').innerHTML = `
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <strong>${escapeHTML(message)}</strong>
                        ${escapeHTML(description)}
                    </div>
                </td>
            </tr>`;
    }

    // LOAD URL
    async function fetchURLs(page = 1, query = '') {
        currentPage = page;

        if (requestController) requestController.abort();
        requestController = new AbortController();

        setLoading();

        try {
            const params = new URLSearchParams({
                page: page,
                per_page: perPage,
                query: query
            });

            const response = await fetch(`fetch_urls.php?${params}`, {
                signal: requestController.signal,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!response.ok) throw new Error(`Server error (${response.status})`);

            const result = await response.json();
            const urls = Array.isArray(result.urls) ? result.urls : [];
            const total = Number(result.total) || 0;

            $('total-urls').textContent = total.toLocaleString('id-ID');
            $('shown-urls').textContent = urls.length.toLocaleString('id-ID');

            if (!urls.length) {
                renderEmpty(
                    query ? 'URL tidak ditemukan' : 'Belum ada URL',
                    query ? 'Coba kata kunci pencarian lainnya.' : 'Mulai dengan membuat short URL pertama Anda.'
                );
            } else {
                const startNumber = (page - 1) * perPage + 1;

                $('url-list').innerHTML = urls.map((url, index) => {
                    const original = String(url.original_url ?? '');
                    const title = String(url.title ?? '');
                    const code = String(url.short_code ?? '');
                    const id = String(url.id ?? '');
                    const safeOriginal = safeURL(original);

                    const truncated = original.length > 38
                        ? original.substring(0, 38) + '...'
                        : original;

                    return `
                    <tr>
                        <td class="number">${startNumber + index}</td>

                        <td>
                            <a class="short-link"
                               href="${escapeHTML(safeOriginal)}"
                               target="_blank"
                               rel="noopener noreferrer">
                                ${escapeHTML(code)}
                                <i class="bi bi-box-arrow-up-right" style="font-size:10px"></i>
                            </a>
                        </td>

                        <td>
                            <span class="original-link"
                                  title="${escapeHTML(original)}">
                                ${escapeHTML(truncated)}
                            </span>
                            ${original.length > 38
                                ? `<a href="#" class="view-more" data-url="${escapeHTML(original)}">Lihat</a>`
                                : ''}
                        </td>

                        <td><span class="url-title" title="${escapeHTML(title)}">${escapeHTML(title)}</span></td>

                        <td><span class="date-text">${escapeHTML(url.updated_at ?? '-')}</span></td>

                        <td>
                            <div class="actions">
                                <button type="button" class="action-btn edit edit-btn"
                                    title="Edit"
                                    data-id="${escapeHTML(id)}"
                                    data-original_url="${escapeHTML(original)}"
                                    data-short_code="${escapeHTML(code)}"
                                    data-title="${escapeHTML(title)}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <button type="button" class="action-btn copy copy-btn"
                                    title="Salin Short Code"
                                    data-short_code="${escapeHTML(code)}">
                                    <i class="bi bi-copy"></i>
                                </button>
                            </div>
                        </td>
                    </tr>`;
                }).join('');
            }

            updatePagination(total, page);

        } catch (error) {
            if (error.name === 'AbortError') return;

            renderEmpty('Gagal memuat data', 'Periksa koneksi database atau file fetch_urls.php.');
            $('pagination').innerHTML = '';
            notify(error.message || 'Terjadi kesalahan saat memuat data.', true);
        }
    }

    // PAGINATION
    function updatePagination(total, page) {
        const totalPages = Math.ceil(total / perPage);
        const pagination = $('pagination');

        if (totalPages <= 1) {
            pagination.innerHTML = '';
            return;
        }

        let html = `
            <button class="page-btn" data-page="${page - 1}" ${page <= 1 ? 'disabled' : ''}>
                <i class="bi bi-chevron-left"></i>
            </button>`;

        let start = Math.max(1, page - 2);
        let end = Math.min(totalPages, start + 4);

        if (end - start < 4) start = Math.max(1, end - 4);

        for (let i = start; i <= end; i++) {
            html += `
                <button class="page-btn ${i === page ? 'active' : ''}" data-page="${i}">
                    ${i}
                </button>`;
        }

        html += `
            <button class="page-btn" data-page="${page + 1}" ${page >= totalPages ? 'disabled' : ''}>
                <i class="bi bi-chevron-right"></i>
            </button>`;

        pagination.innerHTML = html;
    }

    $('pagination').addEventListener('click', event => {
        const button = event.target.closest('[data-page]');
        if (!button || button.disabled) return;

        fetchURLs(Number(button.dataset.page), $('search_query').value.trim());
    });

    // SEARCH WITH DEBOUNCE
    $('search_query').addEventListener('input', function() {
        clearTimeout(searchTimer);

        searchTimer = setTimeout(() => {
            fetchURLs(1, this.value.trim());
        }, 300);
    });

    // GENERATE SHORT URL
    $('shorten-form').addEventListener('submit', async event => {
        event.preventDefault();

        const original_url = $('original_url').value.trim();
        const button = $('generate-btn');

        if (!safeURL(original_url) || safeURL(original_url) === '#') {
            notify('Masukkan URL http:// atau https:// yang valid.', true);
            return;
        }

        button.disabled = true;
        button.innerHTML = '<span class="spinner"></span> Processing...';

        try {
            const result = await requestJSON('generate.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ original_url })
            });

            if (result.success) {
                $('original_url').value = '';
                notify(result.message || 'Short URL berhasil dibuat!');
                await fetchURLs(1, $('search_query').value.trim());
            } else {
                notify('Gagal: ' + (result.message || 'Tidak dapat membuat URL.'), true);
            }

        } catch (error) {
            notify(error.message || 'Gagal menghubungi server.', true);
        } finally {
            button.disabled = false;
            button.innerHTML = '<i class="bi bi-lightning-charge-fill"></i> Generate URL';
        }
    });

    // VIEW MORE
    $('url-list').addEventListener('click', event => {
        const link = event.target.closest('.view-more');
        if (!link) return;

        event.preventDefault();
        const span = link.previousElementSibling;
        span.textContent = link.dataset.url;
        span.style.maxWidth = 'none';
        span.style.whiteSpace = 'normal';
        span.style.overflow = 'visible';
        link.remove();
    });

    // OPEN MODAL
    function openModal() {
        $('editModal').classList.add('show');
        $('edit-original_url').focus();
    }

    function closeModal() {
        $('editModal').classList.remove('show');
    }

    $('close-modal').addEventListener('click', closeModal);

    $('editModal').addEventListener('click', event => {
        if (event.target === $('editModal')) closeModal();
    });

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') closeModal();
    });

    // EDIT BUTTON
    $('url-list').addEventListener('click', event => {
        const button = event.target.closest('.edit-btn');
        if (!button) return;

        $('edit-id').value = button.dataset.id;
        $('edit-original_url').value = button.dataset.original_url;
        $('edit-short_code').value = button.dataset.short_code;
        $('edit-title').value = button.dataset.title;

        openModal();
    });

    // SAVE EDIT
    $('edit-form').addEventListener('submit', async event => {
        event.preventDefault();

        const button = $('save-btn');
        const original_url = $('edit-original_url').value.trim();

        if (!safeURL(original_url) || safeURL(original_url) === '#') {
            notify('Original URL tidak valid.', true);
            return;
        }

        const data = {
            id: $('edit-id').value,
            original_url,
            short_code: $('edit-short_code').value.trim(),
            title: $('edit-title').value.trim()
        };

        button.disabled = true;
        button.textContent = 'Menyimpan...';

        try {
            const result = await requestJSON('edit.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(data)
            });

            if (result.message) {
                notify(result.message, result.success === false);
            }

            if (result.success) {
                closeModal();
                await fetchURLs(currentPage, $('search_query').value.trim());
            }

        } catch (error) {
            notify(error.message || 'Gagal menyimpan perubahan.', true);
        } finally {
            button.disabled = false;
            button.innerHTML = '<i class="bi bi-check-circle"></i> Save Changes';
        }
    });

    // COPY SHORT CODE
    $('url-list').addEventListener('click', async event => {
        const button = event.target.closest('.copy-btn');
        if (!button) return;

        try {
            await navigator.clipboard.writeText(button.dataset.short_code);
            notify('Short code berhasil disalin!');
        } catch {
            notify('Tidak dapat mengakses clipboard browser.', true);
        }
    });

    // INITIAL LOAD
    fetchURLs(1);

});
</script>

</body>
</html>
