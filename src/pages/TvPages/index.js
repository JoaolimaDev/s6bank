import {React, useState} from "react";

import api from '../../Api/Api';

const TvPage = () => {

  const [code_comum, setComum] = useState('');
  const [comum_caixa, setComumcaixa] = useState('');
  const [code_prioritario, setPricode] = useState('');
  const [prioritario_caixa, setPri] = useState('');


  const display = () => {

    const options = {
      headers: {
      'Content-Type': 'application/json'
      }
  
    }


    api.get("/display/", options)
    .then(res => {

     var temp = res['data'];

     setComum(temp.comum_code);

     var temp_c02 = temp.comum_caixa;

     setComumcaixa(temp_c02.caixa);


     var temp_p02 = temp.prioritario_caixa;

     setPricode(temp.prioritario_code)

     setPri(temp_p02.caixa)
     
      
    }).catch(err => { 
     
      alert("Erro contate a rquipe técnica!")
      
    })
  }


  return(
    <div class="main">
       {display()}
      <br></br>
      <div class="letter">
        <h1>Bem Vindo ao S6-Bank</h1>
      </div>
      <div class="letter">
        <h1>Senha Comum:</h1>
        
      </div>
      <div>
       
      <h1 class="letter" >{code_comum}</h1>
      </div>
      <div class="letter">
        Dirigir-se ao <span id="numero-caixa" class="conteudo-caixa"> {comum_caixa} </span>
      </div>
      <br></br>

      <div class="letter">
        <h1>Senha prioritario:</h1>
      </div>
      <div>
      <h1 class="letter" >{code_prioritario}</h1>
      </div>
      <div class="letter">
        Dirigir-se ao <span id="numero-caixa" class="conteudo-caixa"> {prioritario_caixa} </span>
      </div>
    </div>    
  )
};

export default TvPage;