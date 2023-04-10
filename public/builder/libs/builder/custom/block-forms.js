Vvveb.BlocksGroup["Forms"] = ["custom/form-1"];

Vvveb.Blocks.add("custom/form-1", {
    name: "Form 1",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/form-1.PNG",
    html: `
    <section data-name="custom-form-1"> 
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
                <main class="form-signin w-100 m-auto">
                    <form>
                    <img class="mb-4" src="/builder/libs/builder/custom/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Subscribe to my newsletter</h1>
                
                    <div class="form-floating my-2">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating my-2">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div> 
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                    <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
                    </form>
                </main>
            </div>
        </div>
    </section>
    `,
});
