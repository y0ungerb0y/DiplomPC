let currentIdToDelete = null;
const modal = document.getElementById('confirmModal');

function showDeleteModal(id) {
    currentIdToDelete = id;
    modal.style.display = 'flex';
}

document.getElementById('confirmYes').addEventListener('click', function() {
    if (currentIdToDelete) {
        window.location.href = `/api/delete?id=${currentIdToDelete}&type=user`;
    }
});

document.getElementById('confirmNo').addEventListener('click', function() {
    modal.style.display = 'none';
    currentIdToDelete = null;
});

modal.addEventListener('click', function(e) {
    if (e.target === modal) {
        modal.style.display = 'none';
        currentIdToDelete = null;
    }
});