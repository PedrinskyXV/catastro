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

  $("form").validetta({
    realTime: true,
    bubblePosition: "bottom",
    bubbleGapTop: 10,
    bubbleGapLeft: -5,
  });

  console.log("ready!");

  //agregarValidaciones();
  activarMascaras();

  $("#clave").keypress(function (e) {
    console.log("-> key press");
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
  });

  function agregarValidaciones() {

    //#region validetta USUARIO
    $("#usuario").attr("data-validetta", "required,minLength[5],maxLength[50]");
    $("#clave").attr("data-validetta", "required,minLength[8],maxLength[70]");
    $("#usuario_nombre").attr(
      "data-validetta",
      "required,minLength[5],maxLength[50]"
    );
    $("#usuario_apellido").attr(
      "data-validetta",
      "required,minLength[5],maxLength[50]"
    );
    $("#usuario_correo").attr(
      "data-validetta",
      "required,minLength[8],maxLength[80],email"
    );
    $("#sRol").attr("data-validetta", "required,minSelected[1],maxSelected[1]");
    //#endregion        

    //#region validetta PERSONA
    $("#nombre_persona").attr(
      "data-validetta",
      "required,minLength[8],maxLength[100]"
    );
    $("#correo_persona").attr(
      "data-validetta",
      "required,minLength[8],maxLength[50],email"
    );
    $("#direccion_persona").attr(
      "data-validetta",
      "required,minLength[8],maxLength[50]"
    );
    $("#dui").attr("data-validetta", "required,minLength[5],maxLength[50]");
    $("#nit").attr("data-validetta", "required,minLength[5],maxLength[50]");
    $("#telefono_persona").attr(
      "data-validetta",
      "required,minLength[5],maxLength[50]"
    );
    $("#sTipoPersona").attr(
      "data-validetta",
      "required,minSelected[1],maxSelected[1]"
    );
    //#endregion
    
    //#region validetta EMPRESA
    $("#sRubro").attr(
      "data-validetta",
      "required,minSelected[1],maxSelected[1]"
    );

    $("#sActividad").attr(
      "data-validetta",
      "required,minSelected[1],maxSelected[1]"
    );

    $("#nombre_juridico").attr(
      "data-validetta",
      "required,minLength[8],maxLength[150]"
    );

    $("#nombre_comercial").attr(
      "data-validetta",
      "required,minLength[8],maxLength[150]"
    );

    $("#telefono_empresa").attr(
      "data-validetta",
      "required,minLength[9],maxLength[17]"
    );

    $("#correo_empresa").attr(
      "data-validetta",
      "required,minLength[8],maxLength[100],email"
    );

    $("#direccion_empresa").attr(
      "data-validetta",
      "required,minLength[8],maxLength[250]"
    );

    $("#direccion_contacto").attr(
      "data-validetta",
      "required,minLength[8],maxLength[250]"
    );

    $("#sColonia").attr(
      "data-validetta",
      "required,minSelected[1],maxSelected[1]"
    );
    //#endregion

  }

  function activarMascaras()
  {
    $("#dui").inputmask({
      mask: "99999999-9",
    });
    $("#nit").inputmask({
      mask: "9999-999999-999-9",
    });

    $('input[type="tel"]').inputmask({
      mask: "9999-9999",
    });
    $(telPersona).inputmask({
      mask: "9999-9999",
    });
  }

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
