function mostrarAlerta(icono, titulo) {
  const Toast = Swal.mixin({
    toast: true,
    position: "bottom-end",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: icono,
    title: titulo,
  });
}

$(function () {
  console.log("ready!");

  agregarValidaciones();

  $('#clave').keypress(function (e) { 
    console.log('-> key press');
  });

  function agregarValidaciones() {
    $("#usuario").attr("data-validetta", "required,minLength[5],maxLength[50]");
    $("#clave").attr("data-validetta", "required,minLength[8],maxLength[70]");
    $("#unombre").attr("data-validetta", "required,minLength[5],maxLength[50]");
    $("#uapellido").attr(
      "data-validetta",
      "required,minLength[5],maxLength[50]"
    );
    $("#ucorreo").attr(
      "data-validetta",
      "required,minLength[8],maxLength[80],email"
    );
    $("#sRol").attr("data-validetta", "required,minSelected[1],maxSelected[1]");

    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#clave");

    togglePassword.addEventListener("click", function (e) {
      // toggle the type attribute
      const type =
        password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      // toggle the eye / eye slash icon
      this.classList.toggle("bi-eye");
    });
  }

  $("form").validetta({
    realTime: true,
    bubblePosition: "bottom",
    bubbleGapTop: 10,
    bubbleGapLeft: -5,
  });

  $('button[name="btnModificar"], button[name="btnEliminar"]').on(
    "click",
    function (e) {
      e.preventDefault();

      var form = $(this).parent().parent();
      console.log(form);
      //$(form).trigger("submit");
      Swal.fire({
        title: "¿Está seguro?",
        text: "Esto no se podrá revertir!.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, continuar!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.value) {
          $(form).submit();
        }
      });
    }
  );

  $(
    'a[name="btnDarDeAlta"], a[name="btnDarDeBaja"], a[name="restablecerContra"], a[name="btnEliminar"]'
  ).on("click", function (e) {
    e.preventDefault();

    var ref = $(this).attr("href");
    var name = $(this).attr("name");
    var textoAlert = "Esto no se podrá revertir!.";
    console.log(name);
    console.log(ref);
    if (!name.includes("btnEliminar")) {
      textoAlert = "Esto puede afectar a otros usuario.";
    }

    Swal.fire({
      title: "¿Está seguro?",
      text: textoAlert,
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, continuar!",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.value) {
        window.location.href = ref;
      }
    });
  });
});
