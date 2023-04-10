Vvveb.BlocksGroup["Heroes"] = [
    "custom/hero-1",
    "custom/hero-2",
    "custom/hero-3",
    "custom/hero-4",
    "custom/hero-5",
];

Vvveb.Blocks.add("custom/hero-1", {
    name: "Hero 1",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/hero-1.PNG",
    html: `
    <section data-name="custom-hero-1">
        <div class="px-4 py-5 my-5 text-center">
            <img class="d-block mx-auto mb-4" src="/builder/libs/builder/custom/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="display-5 fw-bold text-body-emphasis">Centered hero</h1>
            <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
            </div>
            </div>
        </div>
    </section>
    `,
});

Vvveb.Blocks.add("custom/hero-2", {
    name: "Hero 2",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/hero-2.PNG",
    html: `
    <section data-name="custom-hero-2"> 
        <div class="px-4 pt-5 my-5 text-center border-bottom">
            <h1 class="display-4 fw-bold text-body-emphasis">Centered screenshot</h1>
            <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                <button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Primary button</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
            </div>
            </div>
            <div class="overflow-hidden" style="max-height: 30vh;">
            <div class="container px-5">
                <img src="/builder/libs/builder/custom/assets/bootstrap-docs.png" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
            </div>
            </div>
        </div>
    </section>
    `,
});

Vvveb.Blocks.add("custom/hero-3", {
    name: "Hero 3",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/hero-3.PNG",
    html: `
    <section data-name="custom-hero-3">  
        <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="/builder/libs/builder/custom/assets/bootstrap-themes.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Responsive left-aligned hero with image</h1>
                <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Primary</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button>
                </div>
            </div>
            </div>
        </div>
    </section>
    `,
});

Vvveb.Blocks.add("custom/hero-4", {
    name: "Hero 4",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/hero-4.PNG",
    html: `
    <section data-name="custom-hero-4">
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Vertically centered hero sign-up form</h1>
                <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                    <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
                <hr class="my-4">
                <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                </form>
            </div>
            </div>
        </div>  
    </section>
    `,
});

Vvveb.Blocks.add("custom/hero-5", {
    name: "Hero 5",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/hero-5.PNG",
    html: `
    <section data-name="custom-hero-5">  
        <div class="container my-5">
            <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Border hero with cropped image and shadows</h1>
                <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Primary</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                <img class="rounded-lg-3" src="/builder/libs/builder/custom/assets/bootstrap-docs.png" alt="" width="720">
            </div>
            </div>
        </div>
    </section>
    `,
});
