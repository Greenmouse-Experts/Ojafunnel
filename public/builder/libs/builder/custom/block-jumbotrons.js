Vvveb.BlocksGroup["Jumbotrons"] = [
    "custom/jumbotron-1",
    "custom/jumbotron-2",
    "custom/jumbotron-3",
    "custom/jumbotron-4",
];

Vvveb.Blocks.add("custom/jumbotron-1", {
    name: "Jumbotron 1",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/jumbotron-1.PNG",
    html: `
    <section data-name="custom-jumbotron-1">
        <div class="container my-5">
            <div class="p-5 text-center bg-body-tertiary rounded-3">
            <svg class="bi mt-4 mb-3" style="color: var(--bs-indigo);" width="100" height="100"><use xlink:href="#bootstrap"/></svg>
            <h1 class="text-body-emphasis">Jumbotron with icon</h1>
            <p class="col-lg-8 mx-auto fs-5 text-muted">
                This is a custom jumbotron featuring an SVG image at the top, some longer text that wraps early thanks to a responsive <code>.col-*</code> class, and a customized call to action.
            </p>
            <div class="d-inline-flex gap-2 mb-5">
                <button class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
                Call to action
                <svg class="bi ms-2" width="24" height="24"><use xlink:href="#arrow-right-short"/></svg>
                </button>
                <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
                Secondary link
                </button>
            </div>
            </div>
        </div>  
    </section>
    `,
});

Vvveb.Blocks.add("custom/jumbotron-2", {
    name: "Jumbotron 2",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/jumbotron-2.PNG",
    html: `
    <section data-name="custom-jumbotron-2">
        <div class="container my-5">
            <div class="position-relative p-5 text-center text-muted bg-body border border-dashed rounded-5">
            <button type="button" class="position-absolute top-0 end-0 p-3 m-3 btn-close bg-secondary bg-opacity-10 rounded-pill" aria-label="Close"></button>
            <svg class="bi mt-5 mb-3" width="48" height="48"><use xlink:href="#check2-circle"/></svg>
            <h1 class="text-body-emphasis">Placeholder jumbotron</h1>
            <p class="col-lg-6 mx-auto mb-4">
                This faded back jumbotron is useful for placeholder content. It's also a great way to add a bit of context to a page or section when no content is available and to encourage visitors to take a specific action.
            </p>
            <button class="btn btn-primary px-5 mb-5" type="button">
                Call to action
            </button>
            </div>
        </div>  
    </section>
    `,
});

Vvveb.Blocks.add("custom/jumbotron-3", {
    name: "Jumbotron 3",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/jumbotron-3.PNG",
    html: `
    <section data-name="custom-jumbotron-3">
        <div class="my-5">
            <div class="p-5 text-center bg-body-tertiary">
            <div class="container py-5">
                <h1 class="text-body-emphasis">Full-width jumbotron</h1>
                <p class="col-lg-8 mx-auto lead">
                This takes the basic jumbotron above and makes its background edge-to-edge with a <code>.container</code> inside to align content. Similar to above, it's been recreated with built-in grid and utility classes.
                </p>
            </div>
            </div>
        </div>
    </section>
    `,
});

Vvveb.Blocks.add("custom/jumbotron-4", {
    name: "Jumbotron 4",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/jumbotron-4.PNG",
    html: `
    <section data-name="custom-jumbotron-4">
        <div class="container my-5">
            <div class="p-5 text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">Basic jumbotron</h1>
            <p class="lead">
                This is a simple Bootstrap jumbotron that sits within a <code>.container</code>, recreated with built-in utility classes.
            </p>
            </div>
        </div>  
    </section>
    `,
});
