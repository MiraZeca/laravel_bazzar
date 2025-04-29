@section('title')
    About
@endsection

@extends('home')

@section('main')
    <section>
        <div class="container mt-4">
            <div class="container gallery-container mt-5">
                <h1 class="text-center">Gallery</h1>
                <p class="page-description text-center">Fruits / Vegetables</p>

                <div class="row align-items-center justify-content-evenly">
                    <div class="col-md-3">
                        <div class="filter-box p-2 shadow-sm rounded">
                            <div class="d-flex align-items-center">
                                <select name="category" id="category-filter" class="form-select form-select-sm wg">
                                    <option value="" selected>All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="products-per-page p-2 shadow-sm rounded">
                            <div class="d-flex align-items-center">
                                <select name="et_per_page" id="et_per_page" class="form-select form-select-sm wg">
                                    <option value="16" selected>16</option>
                                    <option value="24">24</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tz-gallery">
                    <div class="row row-cols-3" id="product-gallery">
                        @foreach ($allProducts as $product)
                            <div class="col-sm-6 col-md-4 col-lg-3 product-item"
                                data-category="{{ $product->category_id }}">
                                <a class="lightbox" href="{{ asset('storage/' . $product->image) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="img-fluid rounded-4 shadow-sm">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- PAGINACIJA -->
                <div class="pagination-controls text-center mt-4">
                    <button id="prevPage" class="btn btn-secondary btn-sm me-2" disabled>← </button>
                    <span id="currentPage">Page 1</span>
                    <button id="nextPage" class="btn btn-secondary btn-sm ms-2"> →</button>
                </div><br><br>

            </div>
        </div>
        <br><br><br>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let categoryFilter = document.getElementById("category-filter");
            let perPageSelect = document.getElementById("et_per_page");
            let productGallery = document.getElementById("product-gallery");
            let prevPageBtn = document.getElementById("prevPage");
            let nextPageBtn = document.getElementById("nextPage");
            let currentPageSpan = document.getElementById("currentPage");

            let currentPage = 1;
            let selectedPerPage = parseInt(perPageSelect.value);

            function filterAndPaginateProducts() {
                let selectedCategory = categoryFilter.value;
                selectedPerPage = parseInt(perPageSelect.value);
                let products = Array.from(productGallery.getElementsByClassName("product-item"));

                let filteredProducts = products.filter(product => {
                    let productCategory = product.getAttribute("data-category");
                    return selectedCategory === "" || productCategory === selectedCategory;
                });

                let totalPages = Math.ceil(filteredProducts.length / selectedPerPage);
                if (currentPage > totalPages) currentPage = totalPages || 1;

                let start = (currentPage - 1) * selectedPerPage;
                let end = start + selectedPerPage;

                products.forEach(product => product.style.display = "none");

                filteredProducts.slice(start, end).forEach(product => product.style.display = "block");

                currentPageSpan.textContent = `Page ${currentPage} of ${totalPages}`;

                if (totalPages > 1) {
                    prevPageBtn.style.display = "inline-block";
                    nextPageBtn.style.display = "inline-block";
                    prevPageBtn.disabled = currentPage === 1;
                    nextPageBtn.disabled = currentPage === totalPages || totalPages === 0;
                } else {
                    prevPageBtn.style.display = "none";
                    nextPageBtn.style.display = "none";
                }
            }

            categoryFilter.addEventListener("change", () => {
                currentPage = 1;
                filterAndPaginateProducts();
            });

            perPageSelect.addEventListener("change", () => {
                currentPage = 1;
                filterAndPaginateProducts();
            });

            prevPageBtn.addEventListener("click", () => {
                if (currentPage > 1) {
                    currentPage--;
                    filterAndPaginateProducts();
                }
            });

            nextPageBtn.addEventListener("click", () => {
                currentPage++;
                filterAndPaginateProducts();
            });

            filterAndPaginateProducts();
        });

        baguetteBox.run('.tz-gallery');

        let initialCategory = "{{ request()->route('category') }}"; 

        if (initialCategory) {
            const categoryFilter = document.getElementById("category-filter");
            for (let i = 0; i < categoryFilter.options.length; i++) {
                if (categoryFilter.options[i].text.toLowerCase() === initialCategory.toLowerCase()) {
                    categoryFilter.selectedIndex = i;
                    break;
                }
            }
        }
    </script>
@endsection
