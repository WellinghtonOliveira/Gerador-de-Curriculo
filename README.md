# Gerador de Currículo Profissional

## Descrição

Este projeto é um **Gerador de Currículo Profissional** desenvolvido com **PHP** e estilizado com **Tailwind CSS**. Ele permite que o usuário preencha um formulário com seus dados pessoais, formação acadêmica, experiências profissionais, habilidades e idiomas, e em seguida gera automaticamente um currículo formatado e pronto para impressão.

## Funcionalidades

- **Formulário completo** para inserção de informações profissionais e pessoais
- **Campos dinâmicos** para adicionar múltiplas formações, experiências, habilidades e idiomas
- **Cálculo automático da idade** com base na data de nascimento
- **Geração dinâmica do currículo** com exibição organizada e estilizada
- **Botão de impressão** para facilitar a exportação em papel ou PDF
- **Opção de reiniciar** e preencher novos dados
- **Sanitização de dados** com `htmlspecialchars` para segurança contra XSS

## Tecnologias Utilizadas

- **PHP**: Processamento backend e geração dinâmica do currículo
- **Tailwind CSS**: Estilização moderna e responsiva
- **Font Awesome**: Ícones para melhorar a visualização
- **HTML**: Estruturação do conteúdo

## Como funciona

1. O usuário preenche o formulário com suas informações
2. Ao enviar, os dados são processados pelo backend PHP
3. O currículo é gerado automaticamente e exibido na mesma página
4. O usuário pode imprimir o currículo ou voltar para editar os dados

## Recursos adicionais

- Uso de `DateTime` para cálculo da idade
- Manipulação de arrays complexos para suportar múltiplas entradas
- Layout responsivo com Tailwind para boa visualização em diferentes dispositivos
