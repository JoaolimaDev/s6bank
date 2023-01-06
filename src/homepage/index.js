import "./style.css";
import api from "../Api/Api";
import {React, useState} from "react";
import {Navigate} from "react-router-dom";

const HomePage = () => {

  const [btn, setBtn] = useState('');
  const [atend, setAtend] = useState('');
  const [data, setData] = useState('');
  const [caixa, setCaixa] = useState('');
  const [logout_1, setLogout] = useState(false);

  const buttom = event =>{

  
    setBtn(event.target.value);


    setCaixa(event.target.id);
   

  }

  const handleChange = event => {

    setData(event.target.value)


  }

  const handleSUbmit = () => {

    const parse = JSON.stringify({vetor: btn, caixa: caixa});

    const options = {
      headers: {
      'Content-Type': 'application/json'
      }
  
    }

    api.post("/caixa/", parse, options)
    .then(res => {

      var obj = res['data'];
  

      var alerta = obj.Mensagem[0];

      
  
       alert("Em atendimento : " + alerta.code)
         
       setAtend(alerta.code);
      
    }).catch(err => { 
     
      alert("Erro contate a rquipe técnica!")
      
    })
  }
 
  const final = () => {

    const parse = JSON.stringify({vetor: atend, obs : data});

    const options = {
      headers: {
      'Content-Type': 'application/json'
      }
  
    }

    api.post("/caixa_fim/", parse, options)
    .then(res => {

     // var obj = res['data'];
  

      setAtend('');

      alert("Atendimento Finalizado Prossiga!")
         
      
      
    }).catch(err => { 
     
      alert("Erro contate a rquipe técnica!")
      
    })
    


  }

  const logout = () => {
    document.cookie = "auth=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";


    setLogout(true);
  }

  return(
    <div className="main">
        {logout_1 ? <Navigate to="/login" /> : null }
         <div className="logout">
      <button class="logout" onClick={logout}>
      Logout</button>
    </div>

    <h1 class="letter">Sistema de Caixa S6-Bank</h1>
    <p class="letter">Bem Vindo!</p>
    
    <div class="para-caixas">
    <h1 class="letter">Clique para chamar uma senha:</h1>
    <div>

    
   
    <button onClick={buttom} id="Caixa 1" class="botoes" value = "comum">Caixa 1 comum</button>
    <button onClick={buttom} id="Caixa 2" class="botoes"  value = "comum">Caixa 2 comum</button>
    <button onClick={buttom} id="Caixa 3" class="botoes" value="prioritario">Caixa 3 prioritario</button>
    <button onClick={buttom} id="Caixa 4" class="botoes" value="prioritario">Caixa 4 prioritario</button>
   
   
    <br></br>
    
    <br></br>


    <button onClick = {handleSUbmit} class="botoes">Confirmar</button>

    <div className="logout">
      {"Atendendo " + atend}
      <br></br>
      <br></br>

      <label for = "1-input">Quais as observações ? </label>
      <br></br>
      <br></br>
      <input onChange={handleChange} id = "1-input" type="text"/>
      <br></br>
      <br></br>
      <button class="logout" onClick={final}>
      Finalizar atentimento</button>
    </div>




    
    
    </div> 
    </div>
    </div>
    
  )
};
export default HomePage;