<form id="reviewform_{{ $product->id }}" action="{{ route('reviews.store') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <h4 class="mb-5 fw-bold">Leave a Reply for {{ $product->product_name }}</h4>
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="border-bottom rounded">
                <input name="name" type="text" class="form-control border-0 me-4" placeholder="Your Name *" value="{{ Auth::check() ? Auth::user()->name : '' }}" readonly required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="border-bottom rounded">
                <input name="email" type="email" class="form-control border-0" placeholder="Your Email *" value="{{ Auth::check() ? Auth::user()->email : '' }}" readonly required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="border-bottom rounded my-4">
                <textarea name="comment" id="" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false" required></textarea>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="d-flex justify-content-between py-3 mb-5">
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-3">Please rate:</p>
                    <div class="rating" style="font-size: 24px; direction: rtl;">
                        <i class="fa fa-star" data-value="5"></i>
                        <i class="fa fa-star" data-value="4"></i>
                        <i class="fa fa-star" data-value="3"></i>
                        <i class="fa fa-star" data-value="2"></i>
                        <i class="fa fa-star" data-value="1"></i>
                    </div>
                    <input type="text" name="rating" value="" required style="display: none;">
                </div>
                <button type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3">Post Comment</button>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const stars = document.querySelectorAll('.rating .fa-star');
        const ratingInput = document.querySelector('input[name="rating"]');
        let ratingSelected = false;

        stars.forEach(star => {
            star.addEventListener('click', () => {
                ratingSelected = true;
                const ratingValue = star.getAttribute('data-value');
                ratingInput.value = ratingValue;

                // Reset the color of all stars
                stars.forEach(s => s.classList.remove('selected'));

                // Set the color of the selected stars
                star.classList.add('selected');
                let nextStar = star.nextElementSibling;
                while (nextStar) {
                    nextStar.classList.add('selected');
                    nextStar = nextStar.nextElementSibling;
                }
            });

            star.addEventListener('mouseover', () => {
                stars.forEach(s => s.classList.remove('hover'));
                star.classList.add('hover');
                let nextStar = star.nextElementSibling;
                while (nextStar) {
                    nextStar.classList.add('hover');
                    nextStar = nextStar.nextElementSibling;
                }
            });

            star.addEventListener('mouseout', () => {
                stars.forEach(s => s.classList.remove('hover'));
            });
        });

        // Add event listener to the form
        const form = document.querySelector(`#reviewform_{{ $product->id }}`);
        form.addEventListener('submit', (e) => {
            if (!ratingSelected) {
                e.preventDefault();
                alert('Please select a rating.');
            }
        });
    });
</script>
