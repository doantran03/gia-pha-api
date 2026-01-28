document.addEventListener('DOMContentLoaded', function () {

    // Toggle hiển thị ô ngày mất
    window.toggleDeathDate = function () {
        const checkbox = document.getElementById('has_death_date');
        const wrapper = document.getElementById('death-date-wrapper');
        if (checkbox && wrapper) {
            wrapper.style.display = checkbox.checked ? 'block' : 'none';
        }
    };

    // Preview avatar for member
    const avatarImg   = document.getElementById('preview-avatar');
    const avatarInput = document.getElementById('avatar-input');

    if (avatarImg && avatarInput) {
        avatarImg.addEventListener('click', () => {
            avatarInput.click();
        });

        window.previewAvatar = function(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    avatarImg.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    }

    // Auto generate slug from title
    const titleInput = document.getElementById('title');
    const slugInput  = document.getElementById('slug');

    function slugify(text) {
        return text.toString().toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/đ/g, 'd')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
    }

    if (titleInput && slugInput) {
        titleInput.addEventListener('blur', function () {
            slugInput.value = slugify(this.value);
        });
    }

    // Preview feature image for post
    const featureImageInput = document.getElementById('featured_image');
    const featureImagePreview = document.getElementById('preview_featured_image');

    featureImageInput.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                featureImagePreview.src = e.target.result;
                featureImagePreview.classList.remove('d-none');
                featureImageInput.classList.add('d-none');
            };

            reader.readAsDataURL(file);
        } else {
            featureImagePreview.src = '#';
            featureImagePreview.classList.add('d-none');
            featureImageInput.classList.remove('d-none');
        }
    });

    // Click vào ảnh để chọn lại ảnh khác
    featureImagePreview.addEventListener('click', function () {
        featureImageInput.click();
    });
});
