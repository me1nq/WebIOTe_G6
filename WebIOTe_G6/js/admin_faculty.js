function filterTable() {
    let filterValue = document.getElementById("tableFilter").value;
    let searchValue = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll(".data-row");
    
    rows.forEach(row => {
        let rowProgram = row.getAttribute("data-program");
        let rowName = row.getAttribute("data-name");
        
        let matchProgram = (filterValue === "all" || filterValue === rowProgram);
        let matchName = (rowName.includes(searchValue)); 
        
        if (matchProgram && matchName) row.style.display = ""; 
        else row.style.display = "none"; 
    });
}

function confirmDelete(deleteId) {
    Swal.fire({
        title: 'แน่ใจหรือไม่?', text: "คุณต้องการลบข้อมูลนี้ใช่ไหม!", icon: 'warning',
        showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'ใช่, ลบเลย!', cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) { window.location.href = 'admin_faculty.php?delete_id=' + deleteId; }
    });
}