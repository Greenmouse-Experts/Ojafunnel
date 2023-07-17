Vvveb.SectionsGroup["Navigation Bars"] = [
    "custom/navbar-1",
    "custom/navbar-2",
    "custom/navbar-3",
    "custom/navbar-4",
    "custom/navbar-5",
    "custom/navbar-6",
];

Vvveb.Sections.add("custom/navbar-1", {
    name: "NavBar 1",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/navbar-1.PNG",
    html: `
    <section data-name="custom-navbar-1">
      <nav class="navbar navbar-dark bg-dark" aria-label="First navbar example">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">Never expand</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample01">
            <ul class="navbar-nav me-auto mb-2">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            </ul>
            <form role="search">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
        </div>
    </nav>
    </section> 
    `,
});

Vvveb.Sections.add("custom/navbar-2", {
    name: "NavBar 2",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/navbar-2.PNG",
    html: `
    <section data-name="custom-navbar-2">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Expand at lg</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
            <form role="search">
              <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </form>
          </div>
        </div>
      </nav>
  </section>
    `,
});

Vvveb.Sections.add("custom/navbar-3", {
    name: "NavBar 3",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/navbar-3.PNG",
    html: `
    <section data-name="custom-navbar-3">
        <nav class="navbar navbar-expand-xl navbar-dark bg-dark" aria-label="Sixth navbar example">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Expand at xl</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample06">
            <ul class="navbar-nav me-auto mb-2 mb-xl-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
            <form role="search">
              <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </form>
          </div>
        </div>
      </nav>
    </section>
    `,
});

Vvveb.Sections.add("custom/navbar-4", {
    name: "NavBar 4",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/navbar-4.PNG",
    html: `
    <section data-name="custom-navbar-4">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
        <div class="container">
          <a class="navbar-brand" href="#">Container</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
            <form role="search">
              <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </form>
          </div>
        </div>
      </nav>
    </section>
    `,
});

Vvveb.Sections.add("custom/navbar-5", {
    name: "NavBar 5",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/navbar-5.PNG",
    html: `
    <section data-name="custom-navbar-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Ninth navbar example">
        <div class="container-xl">
          <a class="navbar-brand" href="#">Container XL</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample07XL">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
            <form role="search">
              <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </form>
          </div>
        </div>
      </nav>
    </section>
    `,
});

Vvveb.Sections.add("custom/navbar-6", {
    name: "NavBar 6",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/navbar-6.PNG",
    html: `
    <section data-name="custom-navbar-6">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Tenth navbar example">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Centered nav only</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </section>
    `,
});
