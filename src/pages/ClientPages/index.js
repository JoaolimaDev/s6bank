import {React, useState} from "react";
import api from '../../Api/Api';



const ClientPage = () => {

  const [btn, setBtn] = useState('');
  const [cpf, setCpf] = useState('');


  const handleChange = event => {

    setCpf(event.target.value)


  }


  const handleSubmit = event =>{

    event.preventDefault();

    const parse = JSON.stringify({vetor: btn, cpf: cpf});

    const options = {
      headers: {
      'Content-Type': 'application/json'
      }
  
    }

    api.post("/insert/", parse, options)
    .then(res => {


      var obj = res['data'];
  
     alert("Sua senha é : " + obj.Mensagem)
     
  
      
    }).catch(err => { 
     
      alert("Erro contate a rquipe técnica!")
      
    })

    
  }

  const buttom = event =>{

    
    setBtn(event.target.value);

    
    
  }



  return(

  
    
    <div className="main">

      

      <h1 className="letter"> Bem Vindo ao S6-Bank!</h1>
      <h1 className="letter">Selecione seu tipo de atendimento:</h1>
    
      <form>
      <label className="letter">
        CPF: 

        <input onChange={handleChange} type="text"/>
        
      </label>
      <input onClick={handleSubmit} type="submit" value="Enviar" maxLength="11" pattern="\d+" />
      </form>
      <div className="clientside">
        
        <button  onClick={buttom} className="botoes" value="comum">comum</button>

        <button onClick={buttom}  className="botoes" value="prioritario">Prioritario</button>
      </div>
    </div>
  )
};

export default ClientPage;