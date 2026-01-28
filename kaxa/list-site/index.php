<!doctype html>
<html lang="ka">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Cars List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    .car-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 12px;
      background: #f2f2f2;
    }
  </style>
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <img src="images/logo.png" width="70" alt="Logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto gap-3">
          <!-- აქ როცა გადაარქმევ .php-ზე, ეს ლინკებიც შეცვალე -->
          <li class="nav-item"><a class="nav-link active">კატალოგი</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-4">
    <h2 class="mb-3">🚚 გასაყიდი მანქანები</h2>

    <!-- Filters -->
    <div class="card p-3 mb-3">
      <div class="row g-2 align-items-end">
        <div class="col-md-4">
          <label class="form-label">ძებნა</label>
          <input id="q" class="form-control" placeholder="Volvo, FH16...">
        </div>

        <div class="col-md-2">
          <label class="form-label">Brand</label>
          <input id="brand" class="form-control" placeholder="Volvo">
        </div>

        <div class="col-md-2">
          <label class="form-label">Fuel</label>
          <select id="fuel" class="form-select">
            <option value="">ყველა</option>
            <option>დიზელი</option>
            <option>ბენზინი</option>
            <option>ჰიბრიდი</option>
            <option>ელექტრო</option>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label">Gearbox</label>
          <select id="gearbox" class="form-select">
            <option value="">ყველა</option>
            <option>ავტომატიკა</option>
            <option>მექანიკა</option>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label">Status</label>
          <select id="status" class="form-select">
            <option value="">ყველა</option>
            <option value="available">გასაყიდი</option>
            <option value="sold">გაყიდულია</option>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label">Min ₾</label>
          <input id="minPrice" type="number" class="form-control" placeholder="0">
        </div>
        <div class="col-md-2">
          <label class="form-label">Max ₾</label>
          <input id="maxPrice" type="number" class="form-control" placeholder="200000">
        </div>

        <div class="col-md-2">
          <label class="form-label">Year</label>
          <input id="year" type="number" class="form-control" placeholder="2022">
        </div>

        <div class="col-md-2 d-grid">
          <button id="btnSearch" class="btn btn-primary">Search</button>
        </div>

        <div class="col-md-2 d-grid">
          <button id="btnReset" class="btn btn-outline-secondary">Reset</button>
        </div>
      </div>
    </div>

    <!-- Results -->
    <div id="meta" class="text-muted mb-2"></div>
    <div id="grid" class="row g-3"></div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
      <button id="prev" class="btn btn-outline-dark">Prev</button>
      <div id="pages" class="text-muted"></div>
      <button id="next" class="btn btn-outline-dark">Next</button>
    </div>
  </div>

  <script>
    const els = {
      q: document.getElementById('q'),
      brand: document.getElementById('brand'),
      fuel: document.getElementById('fuel'),
      gearbox: document.getElementById('gearbox'),
      status: document.getElementById('status'),
      minPrice: document.getElementById('minPrice'),
      maxPrice: document.getElementById('maxPrice'),
      year: document.getElementById('year'),
      grid: document.getElementById('grid'),
      meta: document.getElementById('meta'),
      pages: document.getElementById('pages'),
      prev: document.getElementById('prev'),
      next: document.getElementById('next'),
      btnSearch: document.getElementById('btnSearch'),
      btnReset: document.getElementById('btnReset'),
    };

    let state = { page: 1, totalPages: 1 };

    function buildUrl() {
      const p = new URLSearchParams();
      if (els.q.value.trim()) p.set('q', els.q.value.trim());
      if (els.brand.value.trim()) p.set('brand', els.brand.value.trim());
      if (els.fuel.value) p.set('fuel', els.fuel.value);
      if (els.gearbox.value) p.set('gearbox', els.gearbox.value);
      if (els.status.value) p.set('status', els.status.value);
      if (els.minPrice.value) p.set('minPrice', els.minPrice.value);
      if (els.maxPrice.value) p.set('maxPrice', els.maxPrice.value);
      if (els.year.value) p.set('year', els.year.value);
      p.set('page', state.page);
      return `/kaxa/api/cars.php?` + p.toString();
    }

    function cardHtml(car) {
      const img = car.image || 'https://via.placeholder.com/600x400?text=No+Image';
      const badge = car.status === 'sold' ? 'გაყიდულია' : 'გასაყიდი';
      return `
  <div class="col-12 col-md-6 col-lg-4">
    <a href="pages/cars.php?id=${car.id}" class="text-decoration-none text-dark">
      <div class="card shadow-sm h-100 p-2">
        <img class="car-img" src="${img}" alt="">
        <div class="p-2">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-1">${car.brand} ${car.model} - ${car.year}</h5>
            <span class="badge text-bg-primary">${badge}</span>
          </div>
          <div class="text-muted small mb-2">${car.fuel} • ${car.gearbox} • ${car.mileage} კმ</div>
          <div class="fw-bold">${car.price.toLocaleString()} ₾</div>
        </div>
      </div>
    </a>
  </div>
`;

    }

    async function load() {
      const url = buildUrl();
      els.meta.textContent = 'Loading...';
      els.grid.innerHTML = '';

      const res = await fetch(url);
      const json = await res.json();

      state.totalPages = json.totalPages || 1;

      els.meta.textContent = `სულ: ${json.total} | გვერდი: ${json.page}/${state.totalPages}`;
      els.pages.textContent = `${json.page} / ${state.totalPages}`;

      els.prev.disabled = json.page <= 1;
      els.next.disabled = json.page >= state.totalPages;

      if (!json.data.length) {
        els.grid.innerHTML = `<div class="col-12"><div class="alert alert-warning">ვერ მოიძებნა.</div></div>`;
        return;
      }

      els.grid.innerHTML = json.data.map(cardHtml).join('');
    }

    els.btnSearch.addEventListener('click', () => { state.page = 1; load(); });
    els.btnReset.addEventListener('click', () => {
      els.q.value = '';
      els.brand.value = '';
      els.fuel.value = '';
      els.gearbox.value = '';
      els.status.value = '';
      els.minPrice.value = '';
      els.maxPrice.value = '';
      els.year.value = '';
      state.page = 1;
      load();
    });

    els.prev.addEventListener('click', () => { if (state.page > 1) { state.page--; load(); } });
    els.next.addEventListener('click', () => { if (state.page < state.totalPages) { state.page++; load(); } });

    // Enter-ზე search
    ['q', 'brand', 'minPrice', 'maxPrice', 'year'].forEach(id => {
      document.getElementById(id).addEventListener('keydown', (e) => {
        if (e.key === 'Enter') { state.page = 1; load(); }
      });
    });

    load();
  </script>
</body>

</html>