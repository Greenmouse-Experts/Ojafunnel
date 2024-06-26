Vvveb.SectionsGroup["Lists"] = [
    "custom/list-1",
    "custom/list-2",
    "custom/list-3",
    "custom/list-4",
    "custom/list-5",
];

Vvveb.Sections.add("custom/list-1", {
    name: "List 1",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/s-list-1.PNG",
    html: `
    <section data-name="custom-s-list-1">
        <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
            <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">List group item heading</h6>
                    <p class="mb-0 opacity-75">Some placeholder content in a paragraph.</p>
                </div>
                <small class="opacity-50 text-nowrap">now</small>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">Another title here</h6>
                    <p class="mb-0 opacity-75">Some placeholder content in a paragraph that goes a little longer so it wraps to a new line.</p>
                </div>
                <small class="opacity-50 text-nowrap">3d</small>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">Third heading</h6>
                    <p class="mb-0 opacity-75">Some placeholder content in a paragraph.</p>
                </div>
                <small class="opacity-50 text-nowrap">1w</small>
                </div>
            </a>
            </div>
        </div>
    </section>
    `,
});

Vvveb.Sections.add("custom/list-2", {
    name: "List 2",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/s-list-2.PNG",
    html: `
    <section data-name="custom-s-list-2">
        <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
            <div class="list-group">
            <label class="list-group-item d-flex gap-2">
                <input class="form-check-input flex-shrink-0" type="checkbox" value="" checked>
                <span>
                First checkbox
                <small class="d-block text-body-secondary">With support text underneath to add more detail</small>
                </span>
            </label>
            <label class="list-group-item d-flex gap-2">
                <input class="form-check-input flex-shrink-0" type="checkbox" value="">
                <span>
                Second checkbox
                <small class="d-block text-body-secondary">Some other text goes here</small>
                </span>
            </label>
            <label class="list-group-item d-flex gap-2">
                <input class="form-check-input flex-shrink-0" type="checkbox" value="">
                <span>
                Third checkbox
                <small class="d-block text-body-secondary">And we end with another snippet of text</small>
                </span>
            </label>
            </div>
        
            <div class="list-group">
            <label class="list-group-item d-flex gap-2">
                <input class="form-check-input flex-shrink-0" type="radio" name="listGroupRadios" id="listGroupRadios1" value="" checked>
                <span>
                First radio
                <small class="d-block text-body-secondary">With support text underneath to add more detail</small>
                </span>
            </label>
            <label class="list-group-item d-flex gap-2">
                <input class="form-check-input flex-shrink-0" type="radio" name="listGroupRadios" id="listGroupRadios2" value="">
                <span>
                Second radio
                <small class="d-block text-body-secondary">Some other text goes here</small>
                </span>
            </label>
            <label class="list-group-item d-flex gap-2">
                <input class="form-check-input flex-shrink-0" type="radio" name="listGroupRadios" id="listGroupRadios3" value="">
                <span>
                Third radio
                <small class="d-block text-body-secondary">And we end with another snippet of text</small>
                </span>
            </label>
            </div>
        </div>
    </section>
    `,
});

Vvveb.Sections.add("custom/list-3", {
    name: "List 3",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/s-list-3.PNG",
    html: `
    <section data-name="custom-s-list-3">
        <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
            <div class="list-group">
            <label class="list-group-item d-flex gap-3">
                <input class="form-check-input flex-shrink-0" type="checkbox" value="" checked style="font-size: 1.375em;">
                <span class="pt-1 form-checked-content">
                <strong>Finish sales report</strong>
                <small class="d-block text-body-secondary">
                    <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#calendar-event"/></svg>
                    1:00–2:00pm
                </small>
                </span>
            </label>
            <label class="list-group-item d-flex gap-3">
                <input class="form-check-input flex-shrink-0" type="checkbox" value="" style="font-size: 1.375em;">
                <span class="pt-1 form-checked-content">
                <strong>Weekly All Hands</strong>
                <small class="d-block text-body-secondary">
                    <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#calendar-event"/></svg>
                    2:00–2:30pm
                </small>
                </span>
            </label>
            <label class="list-group-item d-flex gap-3">
                <input class="form-check-input flex-shrink-0" type="checkbox" value="" style="font-size: 1.375em;">
                <span class="pt-1 form-checked-content">
                <strong>Out of office</strong>
                <small class="d-block text-body-secondary">
                    <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#alarm"/></svg>
                    Tomorrow
                </small>
                </span>
            </label>
            <label class="list-group-item d-flex gap-3 bg-body-tertiary">
                <input class="form-check-input form-check-input-placeholder bg-body-tertiary flex-shrink-0 pe-none" disabled type="checkbox" value="" style="font-size: 1.375em;">
                <span class="pt-1 form-checked-content">
                <span contenteditable="true" class="w-100">Add new task...</span>
                <small class="d-block text-body-secondary">
                    <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#list-check"/></svg>
                    Choose list...
                </small>
                </span>
            </label>
            </div>
        </div>
    </section>
    `,
});

Vvveb.Sections.add("custom/list-4", {
    name: "List 4",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/s-list-4.PNG",
    html: `
    <section data-name="custom-s-list-4">
        <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
            <div class="list-group list-group-checkable d-grid gap-2 border-0">
            <input class="list-group-item-check pe-none" type="radio" name="listGroupCheckableRadios" id="listGroupCheckableRadios1" value="" checked>
            <label class="list-group-item rounded-3 py-3" for="listGroupCheckableRadios1">
                First radio
                <span class="d-block small opacity-50">With support text underneath to add more detail</span>
            </label>
        
            <input class="list-group-item-check pe-none" type="radio" name="listGroupCheckableRadios" id="listGroupCheckableRadios2" value="">
            <label class="list-group-item rounded-3 py-3" for="listGroupCheckableRadios2">
                Second radio
                <span class="d-block small opacity-50">Some other text goes here</span>
            </label>
        
            <input class="list-group-item-check pe-none" type="radio" name="listGroupCheckableRadios" id="listGroupCheckableRadios3" value="">
            <label class="list-group-item rounded-3 py-3" for="listGroupCheckableRadios3">
                Third radio
                <span class="d-block small opacity-50">And we end with another snippet of text</span>
            </label>
        
            <input class="list-group-item-check pe-none" type="radio" name="listGroupCheckableRadios" id="listGroupCheckableRadios4" value="" disabled>
            <label class="list-group-item rounded-3 py-3" for="listGroupCheckableRadios4">
                Fourth disabled radio
                <span class="d-block small opacity-50">This option is disabled</span>
            </label>
            </div>
        </div>  
    </section>
    `,
});

Vvveb.Sections.add("custom/list-5", {
    name: "List 5",
    dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',
    image: "/builder/libs/builder/custom/images/s-list-5.PNG",
    html: `
    <section data-name="custom-s-list-5">
        <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
            <div class="list-group list-group-radio d-grid gap-2 border-0">
            <div class="position-relative">
                <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid1" value="" checked>
                <label class="list-group-item py-3 pe-5" for="listGroupRadioGrid1">
                <strong class="fw-semibold">First radio</strong>
                <span class="d-block small opacity-75">With support text underneath to add more detail</span>
                </label>
            </div>
        
            <div class="position-relative">
                <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid2" value="">
                <label class="list-group-item py-3 pe-5" for="listGroupRadioGrid2">
                <strong class="fw-semibold">Second radio</strong>
                <span class="d-block small opacity-75">Some other text goes here</span>
                </label>
            </div>
        
            <div class="position-relative">
                <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid3" value="">
                <label class="list-group-item py-3 pe-5" for="listGroupRadioGrid3">
                <strong class="fw-semibold">Third radio</strong>
                <span class="d-block small opacity-75">And we end with another snippet of text</span>
                </label>
            </div>
        
            <div class="position-relative">
                <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid4" value="" disabled>
                <label class="list-group-item py-3 pe-5" for="listGroupRadioGrid4">
                <strong class="fw-semibold">Fourth disabled radio</strong>
                <span class="d-block small opacity-75">This option is disabled</span>
                </label>
            </div>
            </div>
        </div>
    </section>
    `,
});
