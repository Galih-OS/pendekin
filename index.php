<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendekin URL</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
  <link rel="shortcut icon" href="https://icons.iconarchive.com/icons/rokey/the-last-order-candy/128/internet-icon.png">
</head>
<body>
<div class="container mt-5">
  <h1 class="text-center">PENDEKIN AJA</h1></br>
  <div class="row">
    <div class="col-md-12">
      <form id="shorten-form" class="form-inline">
        <div class="form-group mr-2">
          <label for="original_url" class="sr-only">Enter URL:</label>
          <input type="url" id="original_url" class="form-control" placeholder="Enter URL" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate Short URL</button>
        <div class="form-group ml-auto">
          <input type="text" id="search_query" class="form-control" placeholder="Search URLs">
          <button type="button" class="btn btn-secondary ml-2" id="search_button"><i class="bi bi-search"></i></button>
        </div>
      </form>
      <div id="result" class="mt-3"></div>
      <div class="table-responsive mt-3"></br>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th style="width:110px">Short URL</th>
              <th style="width:280px">Original URL</th>
              <th style="width:300px">Title</th>
              <th style="width:200px">Updated At</th>
              <th style="width:130px">Actions</th>
            </tr>
          </thead>
          <tbody id="url-list"></tbody>
        </table>
      </div>
      <div id="pagination" class="mt-3 d-flex justify-content-center"></div>
    </div>
  </div>
</div>

<!-- Modal for Editing Short URL -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Short URL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-form">
          <input type="hidden" id="edit-id">
          <div class="form-group">
            <label for="edit-original_url">Original URL:</label>
            <input type="url" id="edit-original_url" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="edit-short_code">Short Code:</label>
            <input type="text" id="edit-short_code" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="edit-title">Title:</label>
            <input type="text" id="edit-title" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  let currentPage = 1;
  const perPage = 5;

  function fetchURLs(page = 1, query = '') {
    currentPage = page;
    $.get('fetch_urls.php', { page: page, per_page: perPage, query: query }, function(data) {
      const result = JSON.parse(data);
      const urls = result.urls;
      const total = result.total;
      let urlListHTML = '';
      let count = (page - 1) * perPage + 1;
      urls.forEach(url => {
        let truncatedUrl = url.original_url.length > 30 ? url.original_url.substring(0, 30) + '...' : url.original_url;
        urlListHTML +=
          `<tr>
            <td>${count++}</td>
            <td><a href="${url.original_url}" target="_blank">${url.short_code}</a></td>
            <td>
              <span class="short-url">${truncatedUrl}</span>
              ${url.original_url.length > 30 ? `<a href="#" class="view-more" data-url="${url.original_url}">Selengkapnya</a>` : ''}
            </td>
            <td>${url.title}</td>
            <td>${url.updated_at}</td>
            <td>
              <button class="btn btn-sm btn-secondary edit-btn" data-id="${url.id}" data-original_url="${url.original_url}" data-short_code="${url.short_code}" data-title="${url.title}"><i class="bi bi-pencil-square"></i></button>
              <button class="btn btn-sm btn-danger delete-btn" data-id="${url.id}"><i class="bi bi-trash"></i></button>
              <button class="btn btn-sm btn-info copy-btn" data-short_code="${url.short_code}"><i class="bi bi-share"></i></button>
            </td>
          </tr>`;
      });
      $('#url-list').html(urlListHTML);
      updatePagination(total, page);
    });
  }

  function updatePagination(total, page) {
    const totalPages = Math.ceil(total / perPage);
    const maxPagesToShow = 5;
    let paginationHTML = '';

    if (page > 1) {
      paginationHTML += `<button class="btn btn-primary mx-1" data-page="${page - 1}">Previous</button>`;
    }

    let startPage = Math.max(1, page - Math.floor(maxPagesToShow / 2));
    let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

    if (endPage - startPage + 1 < maxPagesToShow) {
      startPage = Math.max(1, endPage - maxPagesToShow + 1);
    }

    for (let i = startPage; i <= endPage; i++) {
      paginationHTML +=
        `<button class="btn btn-primary mx-1 ${i === page ? 'active' : ''}" data-page="${i}">${i}</button>`;
    }

    if (page < totalPages) {
      paginationHTML += `<button class="btn btn-primary mx-1" data-page="${page + 1}">Next</button>`;
    }

    $('#pagination').html(paginationHTML);
  }

  // Event listener for pagination buttons
  $(document).on('click', '#pagination button', function() {
    const page = $(this).data('page');
    fetchURLs(page, $('#search_query').val());
  });

  // Event listener for "Selengkapnya" button
  $(document).on('click', '.view-more', function(e) {
    e.preventDefault();
    const url = $(this).data('url');
    $(this).prev('.short-url').text(url);
    $(this).remove();
  });

  // Event listener for form to generate short URL
  $('#shorten-form').on('submit', function(e) {
    e.preventDefault();
    const original_url = $('#original_url').val();
    $.post('generate.php', { original_url: original_url }, function(data) {
      const result = JSON.parse(data);
      if (result.success) {
        fetchURLs(1, $('#search_query').val()); // Refresh the list after adding new URL
        $('#original_url').val('');
      } else {
        alert('Failed to generate short URL: ' + result.message);
      }
    });
  });

  // Event listener for search input
  $('#search_query').on('input', function() {
    fetchURLs(1, $(this).val());
  });

  // Event listener for search on enter key
  $('#search_query').on('keypress', function(e) {
    if (e.which == 13) {
      fetchURLs(1, $(this).val());
    }
  });

  // Event listener for edit form submission
  $('#edit-form').on('submit', function(e) {
    e.preventDefault();
    const id = $('#edit-id').val();
    const original_url = $('#edit-original_url').val();
    const short_code = $('#edit-short_code').val();
    const title = $('#edit-title').val();
    $.post('edit.php', { id: id, original_url: original_url, short_code: short_code, title: title }, function(data) {
      const result = JSON.parse(data);
      alert(result.message);
      $('#editModal').modal('hide');
      fetchURLs(currentPage, $('#search_query').val()); // Refresh the list after editing
    });
  });

  // Event delegation for edit, delete, and copy actions
  $(document).on('click', '.edit-btn', function() {
    const id = $(this).data('id');
    const original_url = $(this).data('original_url');
    const short_code = $(this).data('short_code');
    const title = $(this).data('title');
    $('#edit-id').val(id);
    $('#edit-original_url').val(original_url);
    $('#edit-short_code').val(short_code);
    $('#edit-title').val(title);
    $('#editModal').modal('show');
  });

  $(document).on('click', '.delete-btn', function() {
    const id = $(this).data('id');
    if (confirm('Sudah Yakin Ingin Menghapus?')) {
      $.post('delete.php', { id: id }, function(data) {
        const result = JSON.parse(data);
        alert(result.message);
        fetchURLs(currentPage, $('#search_query').val()); // Refresh the list after deleting
      });
    }
  });

  $(document).on('click', '.copy-btn', function() {
    const short_code = $(this).data('short_code');
    navigator.clipboard.writeText(short_code).then(function() {
      alert('Data Berhasil Disalin');
    });
  });

  // Initial data fetch
  fetchURLs(currentPage);
});

</script>

<section class="bottom-footer py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <p class="mb-0 text-center text-muted">©
                        <script>document.write(new Date().getFullYear())</script><i class="mdi mdi-heart text-danger"></i> by <a href="https://galih-os.github.io/" target="_blank" class="text-muted">Galih-OS.</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
