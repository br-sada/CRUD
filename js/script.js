
//submit formulario OK!
$('#form').submit(function(e){
    e.preventDefault();

    $.ajax({
        url: '../../app/model/metodos.php',
        method: 'POST',
        data: {
            nome:$('#nome').val(),
            email:$('#email').val(),
            cpf:$('#cpf').val(),
            senha:$('#senha').val(),
            button:$('#cadastrar').val()
        }
    }).done(function(resultado){
        $('#form')[0].reset();
        //console.log(resultado);
        getDados();
    })
});

//click botão logout OK!
$('#logout').on('click', function(){
  $.ajax({
    url: '../../app/model/metodos.php',
    method: 'POST',
    data: {
      button:$('#logout').val()
    }
  }).done(function(resultado){
    if(resultado == 0) {
      location.href = '../../index.html';
    }
  })
})

//pega os dados do php e lista na tela OK!
function getDados(){
    $.ajax({
        url: '../../app/model/metodos.php',
        method: 'POST',
        dataType: 'json',
        data: {
            button: "buscarTudo"
        }    
    }).done(function(resultado){
        //console.log(resultado)

        $('.table-data > tr').remove(); //remove a linha atual para prencher com novos dados.

        resultado.forEach(item => {
          //console.log(item['id'], item['nome'], item['email'], item['cpf'], item['senha']);

          $('.table-data').prepend(`
            <tr>
              <td>${item['nome']}</td>
              <td>${item['email']}</td>
              <td>${item['cpf']}</td>
              <td>${item['senha']}</td>
              <td>
                <button class="btn btn-primary text-center editar" type="button" id="${item['id']}" value="editar">Editar</button>
                <button class="btn btn-primary text-center apagar" type="button" id="${item['id']}" value="excluir">Apagar</button>
              </td>
            </tr>
          `);

        });
    });
}

//click botão apagar OK!
$(document).on('click', '.apagar', function(){
  //teste de retorno no console
  //let id = $(this).attr('id');
  //let button = $(this).val();
  //console.log(id, button);

  $.ajax({
    url: '../../app/model/metodos.php',
    method: 'POST',
    data: {
        id:$(this).attr('id'),
        button:$(this).val()
    }
  }).done(function(resultado){
      //console.log(resultado);
      getDados();
  })
});

//click botão editar OK!
$(document).on('click', '.editar', function(){

  $.ajax({
    url: '../../app/model/metodos.php',
    method: 'POST',
    dataType: 'json',
    data: {
      id:$(this).attr('id'),
      button:$(this).val()
    }
  }).done(function(resultado){
      console.log(resultado);
      $("#id-hide").val(resultado['id']);
      $('#nome').val(resultado['nome']);
      $('#email').val(resultado['email']);
      $('#cpf').val(resultado['cpf']);
      $('#senha').val(resultado['senha']);
      
      //esconde o botao cadastrar
      $('#cadastrar').hide()
      //cria no lugar um botão atualizar dinamicamente
      $('#btn-area').prepend(`
        <button class="btn btn-primary text-center editar" type="button" id="atualizar" value="atualizar">Atualizar</button>
      `);
  });
});

//click botão atualizar OK!
$(document).on('click', '#atualizar', function(){
  let valor = $('#atualizar').val();
  //console.log(valor);

  $.ajax({
    url: '../../app/model/metodos.php',
    method: 'POST',
    data: {
      id:$('#id-hide').val(),
      nome:$('#nome').val(),
      email:$('#email').val(),
      cpf:$('#cpf').val(),
      senha:$('#senha').val(),
      button:$(this).val()
    }
  }).done(function(resultado){
    //console.log(resultado);
    $('#form')[0].reset();
    $('#atualizar').remove();
    $('#cadastrar').show();
    getDados();
  })
})

/*----------------------------------------------------login-----------------------------------------------*/

//click botão entrar OK!
$('#loginEntrar').on('click', function(e){
    e.preventDefault();    
    $.ajax({
        url: 'http://localhost:8080/CRUD/app/model/metodos.php',
        method: 'POST',
        data: {
            email:$('#loginUsuario').val(),
            senha:$('#loginSenha').val(),
            button:$('#loginEntrar').val()
        }
    }).done(function(resultado){
        
        if(resultado == 'false') {
          
          console.log("Dados incorretos");
          $('#form')[0].reset();

        } else {

          // acesso autenticado e redireciona para página
          location.href = 'http://localhost:8080/CRUD/app/view/cadastros.php';

        }
    })
});

getDados();