$('div.grid-view a.text-danger, a.delete-dialog').click(function(event) {
    event.preventDefault();
    
    var url = $(this).attr('href');

    Swal.fire({
        title: 'Hapus Data',
        text: 'Apakah anda yakin ingin menghapus data?',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons:true,
        confirmButtonText: 'Ya, Hapus Data!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : url,
                type : 'POST',
                success : function(data){
                    if (data.code == 200) {
                        var title = 'Sukses!';
                        var message = 'Data Berhasil Dihapus.';
                        var icon = 'success';
                    } else {
                        var title = 'Gagal!';
                        var message = 'Data Gagal Dihapus.';
                        var icon = 'error';
                    }
                    Swal.fire(
                        title,
                        message,
                        icon
                    ).then((result) => {
                        location.reload();
                    });
                }
            });
        }
    })
});