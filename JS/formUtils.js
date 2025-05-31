// Calcular idade automaticamente
function calculateAge() {
    const birthDate = new Date(document.getElementById('birthDate').value);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    document.getElementById('age').textContent = age;
}

// Função genérica para remover campos
function removeField(button) {
    const field = button.closest('.dynamic-field');
    if (field) field.remove();
}

// Adicionar campos dinâmicos
function addEducationField() { /* ... mesmo código ... */ }
function addExperienceField() { /* ... mesmo código ... */ }
function addSkillField() { /* ... mesmo código ... */ }
function addLanguageField() { /* ... mesmo código ... */ }

// Limpar o formulário
function resetForm() { /* ... mesmo código ... */ }
