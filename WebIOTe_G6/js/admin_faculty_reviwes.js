function filterReviews() {
    let filterVal = document.getElementById("filterProfessor").value;
    let searchVal = document.getElementById("searchReviewInput").value.toLowerCase();
    let rows = document.querySelectorAll(".review-row");
    
    rows.forEach(row => {
        let pid = row.getAttribute("data-pid");
        let name = row.getAttribute("data-name");
        
        let matchDropdown = (filterVal === "all" || filterVal === pid);
        let matchSearch = (name.includes(searchVal));
        
        if (matchDropdown && matchSearch) row.style.display = "";
        else row.style.display = "none";
    });
}

function confirmDeleteReview(reviewId) {
    Swal.fire({
        title: 'ลบความคิดเห็นนี้?', text: "คุณไม่สามารถกู้คืนข้อมูลนี้ได้!", icon: 'warning',
        showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'ใช่, ลบเลย!', cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) { window.location.href = 'admin_faculty_reviews.php?delete_review_id=' + reviewId; }
    });
}