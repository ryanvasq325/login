import { Validate } from "./Validate.js";
import { Requests } from "./Requests.js";

const preCadastro = document.getElementById('preCadastro');

$('#cpf').inputmask({ "mask": ["999.999.999-99"] });
$('#celular').inputmask({ "mask": ["(99) 99999-9999"] });
$('#whatsapp').inputmask({ "mask": ["(99) 99999-9999"] });

preCadastro.addEventListener('click', async () => {
    try {
        const response = await Requests.SetForm('form').Post('login/precadastro');
        if(response.status) {
            
        }
    } catch (error) {
        console.log(error);
    }
});

