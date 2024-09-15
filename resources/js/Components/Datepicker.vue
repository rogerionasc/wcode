<template>
    <VueDatePicker 
    :aria-labels="ariaLabelsPtBr"
    :format-locale="ptBR"
    :enable-time-picker="false"
    :action-row="{ showNow: true }" 
    now-button-label="Agora"
    select-text="Selecionar"
    cancel-text="Fechar"
    position="right"
    placeholder="Selecione uma data"
    
    />
</template>
  
  <script setup>  
  import { ref } from 'vue';
  import { ptBR } from 'date-fns/locale';

  // Definindo os rótulos em português
  const ariaLabelsPtBr = ref({
    toggleOverlay: "Alternar sobreposição",
    menu: "Menu",
    input: "Entrada",
    openTimePicker: "Abrir seletor de horário",
    closeTimePicker: "Fechar seletor de horário",
    incrementValue: (type) => `Aumentar valor de ${type === 'hours' ? 'horas' : type === 'minutes' ? 'minutos' : 'segundos'}`,
    decrementValue: (type) => `Diminuir valor de ${type === 'hours' ? 'horas' : type === 'minutes' ? 'minutos' : 'segundos'}`,
    openTpOverlay: (type) => `Abrir sobreposição de ${type === 'hours' ? 'horas' : type === 'minutes' ? 'minutos' : 'segundos'}`,
    amPmButton: "Alternar AM/PM",
    openYearsOverlay: "Abrir sobreposição de anos",
    openMonthsOverlay: "Abrir sobreposição de meses",
    nextMonth: "Próximo mês",
    prevMonth: "Mês anterior",
    nextYear: "Próximo ano",
    prevYear: "Ano anterior",
    day: ({ value }) => `Dia ${value.getDate()}`,
    weekDay: (day) => `Dia da semana ${day}`,
    clearInput: "Limpar entrada",
    calendarIcon: "Ícone do calendário",
    timePicker: "Seletor de horário",
    monthPicker: (overlay) => overlay ? "Sobreposição de meses" : "Selecionar mês",
    yearPicker: (overlay) => overlay ? "Sobreposição de anos" : "Selecionar ano",
    timeOverlay: (type) => `Sobreposição de ${type === 'hours' ? 'horas' : type === 'minutes' ? 'minutos' : 'segundos'}`
  });
  </script>
  
  <style scoped>
  /* Adicione seu estilo aqui, se necessário */
  </style>
  