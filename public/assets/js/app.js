document.addEventListener('DOMContentLoaded', function () {
    // Toggle hiển thị ô ngày mất
    window.toggleDeathDate = function () {
        const checkbox = document.getElementById('has_death_date');
        const wrapper = document.getElementById('death-date-wrapper');

        wrapper.style.display = checkbox.checked ? 'block' : 'none';
    };

    const avatarImg   = document.getElementById('preview-avatar');
    const avatarInput = document.getElementById('avatar-input');

    // Click vào ảnh -> mở chọn file
    if (!avatarImg || !avatarInput) return;

    avatarImg.addEventListener('click', () => {
        avatarInput.click();
    });

    // Preview ảnh sau khi chọn
    window.previewAvatar = function(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                avatarImg.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
});