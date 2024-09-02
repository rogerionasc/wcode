export default {
    mounted() {
        
    },

    methods: {
        validateEmailFormat (email) {
            // Regex para validar o formato de e-mail
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        },
        validateCPF(cpf) {
            cpf = cpf.replace(/[^\d]/g, ''); // Remove caracteres não numéricos

            // Verifica se o CPF tem 11 dígitos
            if (cpf.length !== 11) {
                return false;
            }

            // Verifica se todos os dígitos são iguais
            if (/^(\d)\1+$/.test(cpf)) {
                return false;
            }

            // Calcula os dígitos verificadores
            let sum = 0;
            for (let i = 0; i < 9; i++) {
                sum += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let remainder = 11 - (sum % 11);
            let digit1 = remainder >= 10 ? 0 : remainder;

            sum = 0;
            for (let i = 0; i < 10; i++) {
                sum += parseInt(cpf.charAt(i)) * (11 - i);
            }
            remainder = 11 - (sum % 11);
            let digit2 = remainder >= 10 ? 0 : remainder;

            // Verifica se os dígitos verificadores calculados são iguais aos dígitos verificadores fornecidos
            return digit1 === parseInt(cpf.charAt(9)) && digit2 === parseInt(cpf.charAt(10));
        },

        getStatusClass(status) {
            switch (status) {
                case 'pendente':
                    return 'badge-warning';
                case 'concluido':
                    return 'badge-success';
                case 'atendimento':
                    return 'badge-info';
                default:
                    return '';
            }
        },

        formatarData(data) {
            const dataFormatada = new Date(data);
            const dia = dataFormatada.getDate();
            const mes = dataFormatada.toLocaleString('default', { month: 'long' });
            const ano = dataFormatada.getFullYear();
            const hora = dataFormatada.getHours();
            const minutos = dataFormatada.getMinutes();

            return `${dia} ${mes} ${ano} | ${hora}h${minutos}m`;
        },

        formatDate(date) {
            const formatDate = new Date(date);
            const day = ("0" + formatDate.getDate()).slice(-2);
            const month = ("0" + (formatDate.getMonth() + 1)).slice(-2);
            const year = formatDate.getFullYear();

            return `${day}/${month}/${year}`;
        },

        formatTextToUpperCase(text) {
            return text.toUpperCase();
        },
    }

}
