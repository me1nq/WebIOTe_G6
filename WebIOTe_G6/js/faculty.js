function openModal(element) {
    let pidInput = document.getElementById('personnelId');
    if (pidInput) {
        pidInput.value = element.getAttribute('data-id');
    }

    document.getElementById('modalName').innerText = element.getAttribute('data-name');
    
    let popupRole = element.getAttribute('data-popup-role');
    let mainRole = element.getAttribute('data-role');
    document.getElementById('modalRole').innerText = popupRole ? popupRole : mainRole;

    document.getElementById('modalHistory').innerText = element.getAttribute('data-history');
    document.getElementById('modalImage').src = element.getAttribute('data-image');
    
    let resDesc = element.getAttribute('data-research');
    let resLink = element.getAttribute('data-research-link');
    let resImg = element.getAttribute('data-research-image');
    
    let researchSection = document.getElementById('researchSection');
    let descElement = document.getElementById('modalResearchDesc');
    let linkWrapper = document.getElementById('modalResearchLink');
    let imgElement = document.getElementById('modalResearchImg');

    if ((resDesc && resDesc.trim() !== '') || (resImg && resImg.trim() !== '')) {
        researchSection.style.display = 'block';
        descElement.innerText = resDesc ? resDesc : '';

        if (resImg && resImg.trim() !== '') {
            imgElement.src = resImg;
            linkWrapper.style.display = 'block'; 
            
            if (resLink && resLink.trim() !== '') {
                linkWrapper.href = resLink;
                linkWrapper.style.cursor = 'pointer';
            } else {
                linkWrapper.removeAttribute('href');
                linkWrapper.style.cursor = 'default';
            }
        } else {
            linkWrapper.style.display = 'none'; 
        }
    } else {
        researchSection.style.display = 'none';
    }

    let commentBox = document.getElementById('commentText');
    if (commentBox) {
        commentBox.value = ''; 
    }
    
    document.getElementById('facultyModal').style.display = 'flex';
    
    let scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;

    document.body.style.overflow = 'hidden';
    document.body.style.paddingRight = scrollbarWidth + 'px';
}

function closeModal(event, forceClose = false) {
    if (forceClose || event.target.className === 'modal-overlay') {
        document.getElementById('facultyModal').style.display = 'none';

        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }
}

async function submitComment(event) {
    event.preventDefault(); 
    const p_id = document.getElementById('personnelId').value;
    const comment = document.getElementById('commentText').value;

    let formData = new FormData();
    formData.append('personnel_id', p_id);
    formData.append('comment_text', comment);

    try {
        // 🔴 เช็คพาธตรงนี้นะ ถ้าไฟล์ save_comment.php อยู่หน้าบ้าน ใช้แบบนี้ได้เลย
        let response = await fetch('save_comment.php', { method: 'POST', body: formData });
        let result = await response.text();
        
        if(result === "success") {
            closeModal(event, true); 
            
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: 'ส่งความคิดเห็นของคุณเรียบร้อยแล้ว ขอบคุณครับ!',
                confirmButtonColor: '#FF6F00'
            });
            
            document.getElementById('commentText').value = ''; 
        } else {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: result,
                confirmButtonColor: '#dc3545'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'เชื่อมต่อเซิร์ฟเวอร์ไม่ได้',
            text: error,
            confirmButtonColor: '#dc3545'
        });
    }   
}