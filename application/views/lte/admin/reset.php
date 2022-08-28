<form 
    class="form-horizontal action-reset"
    data-action-url="<?=base_url("admin/reset")?>">

    <div class="form-group">
        <label class="col-md-3 control-label">Kode Reset</label>
        <div class="col-md-12">
            <input placeholder="Secret Key" name="code" id="code" type="password" class="form-control" />
            <span class="help-block form-error" id="code-error"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-12">
           <button type="submit" class="btn btn-info btn-block btn-reset">Reset</button>
        </div>
    </div>

</form>

<script>
 $(document.body).on("submit", ".action-reset", function (e) {
        e.preventDefault();
        const el = $(this);
        let url = el.data('action-url');
        let data = new FormData(this);

        const btnName = $(".btn-reset").html();
            setLoading(".btn-reset", "Loading...");
            removeFormError(); 

            reqFormData(url, 'POST', data, (err, response) => {  
                if (response) {
                    if ($.isEmptyObject(response.errors)) {
                        swal("Sukses", response.message, "success");
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        swal("Eror", "Terjadi Kesalahan", "error");
                        errorHandler(response.errors);
                    }
                } else {
                    console.log("Error: ", err);
                }

                setFinish(".btn-reset", btnName);
            });
    });

</script>