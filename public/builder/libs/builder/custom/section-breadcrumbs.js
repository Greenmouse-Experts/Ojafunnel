Vvveb.SectionsGroup["Breadcrumbs"] = [
    "custom/breadcrumb-1",
    "custom/breadcrumb-2",
    "custom/breadcrumb-3",
];

Vvveb.Sections.add("custom/breadcrumb-1", {
    name: "Breadcrumb 1",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/breadcrumb-1.PNG",
    html: ` 
    <section data-name="custom-breadcrumb-1">  
        <div class="container my-5">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-3 bg-body-tertiary rounded-3">
                <li class="breadcrumb-item">
                <a class="link-body-emphasis" href="#">
                    <svg class="bi" width="16" height="16"><use xlink:href="#house-door-fill"></use></svg>
                    <span class="visually-hidden">Home</span>
                </a>
                </li>
                <li class="breadcrumb-item">
                <a class="link-body-emphasis fw-semibold text-decoration-none" href="#">Library</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                Data
                </li>
            </ol>
            </nav>
        </div>
    </section> 
    `,
});

Vvveb.Sections.add("custom/breadcrumb-2", {
    name: "Breadcrumb 2",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/breadcrumb-2.PNG",
    html: ` 
    <section data-name="custom-breadcrumb-2">  
        <div class="container my-5">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">
                <li class="breadcrumb-item">
                <a class="link-body-emphasis" href="#">
                    <svg class="bi" width="16" height="16"><use xlink:href="#house-door-fill"></use></svg>
                    <span class="visually-hidden">Home</span>
                </a>
                </li>
                <li class="breadcrumb-item">
                <a class="link-body-emphasis fw-semibold text-decoration-none" href="#">Library</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                Data
                </li>
            </ol>
            </nav>
        </div>
    </section> 
    `,
});

Vvveb.Sections.add("custom/breadcrumb-3", {
    name: "Breadcrumb 3",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/breadcrumb-3.PNG",
    html: ` 
    <section data-name="custom-breadcrumb-3">  
        <div class="container my-5">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom overflow-hidden text-center bg-body-tertiary border rounded-3">
                <li class="breadcrumb-item">
                <a class="link-body-emphasis fw-semibold text-decoration-none" href="#">
                    <svg class="bi" width="16" height="16"><use xlink:href="#house-door-fill"></use></svg>
                    Home
                </a>
                </li>
                <li class="breadcrumb-item">
                <a class="link-body-emphasis fw-semibold text-decoration-none" href="#">Library</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                Data
                </li>
            </ol>
            </nav>
        </div>
    </section> 
    `,
});
