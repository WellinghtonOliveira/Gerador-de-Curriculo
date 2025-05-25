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

// Adicionar campos de formação
function addEducationField() {
    const container = document.getElementById('education-container');
    const newField = document.createElement('div');
    newField.className = 'education-item dynamic-field bg-gray-50 p-4 rounded-lg mb-3';
    newField.innerHTML = `
                <div class="flex justify-between items-start">
                    <div class="w-3/4">
                        <input type="text" placeholder="Curso/Grau" class="education-course w-full px-3 py-1 border rounded mb-2">
                        <input type="text" placeholder="Instituição" class="education-institution w-full px-3 py-1 border rounded mb-2">
                    </div>
                    <div class="w-1/4 pl-2">
                        <input type="text" placeholder="Ano" class="education-year w-full px-3 py-1 border rounded">
                    </div>
                </div>
                <textarea placeholder="Detalhes adicionais" class="education-details w-full px-3 py-1 border rounded mt-2" rows="2"></textarea>
                <button onclick="removeField(this)" class="mt-2 bg-red-100 text-red-600 px-3 py-1 rounded text-sm hover:bg-red-200 transition">
                    <i class="fas fa-trash mr-1"></i> Remover
                </button>
            `;
    container.appendChild(newField);
}

// Adicionar campos de experiência
function addExperienceField() {
    const container = document.getElementById('experience-container');
    const newField = document.createElement('div');
    newField.className = 'experience-item dynamic-field bg-gray-50 p-4 rounded-lg mb-3';
    newField.innerHTML = `
                <div class="flex justify-between items-start">
                    <div class="w-3/4">
                        <input type="text" placeholder="Cargo" class="experience-position w-full px-3 py-1 border rounded mb-2">
                        <input type="text" placeholder="Empresa" class="experience-company w-full px-3 py-1 border rounded mb-2">
                    </div>
                    <div class="w-1/4 pl-2">
                        <input type="text" placeholder="Período" class="experience-period w-full px-3 py-1 border rounded">
                    </div>
                </div>
                <textarea placeholder="Descrição das atividades" class="experience-description w-full px-3 py-1 border rounded mt-2" rows="3"></textarea>
                <button onclick="removeField(this)" class="mt-2 bg-red-100 text-red-600 px-3 py-1 rounded text-sm hover:bg-red-200 transition">
                    <i class="fas fa-trash mr-1"></i> Remover
                </button>
            `;
    container.appendChild(newField);
}

// Adicionar campos de habilidades
function addSkillField() {
    const container = document.getElementById('skills-container');
    const newField = document.createElement('div');
    newField.className = 'skill-item dynamic-field flex items-center mb-2';
    newField.innerHTML = `
                <input type="text" placeholder="Habilidade" class="skill-name w-full px-3 py-1 border rounded mr-2">
                <select class="skill-level px-3 py-1 border rounded">
                    <option value="1">Iniciante</option>
                    <option value="2">Intermediário</option>
                    <option value="3">Avançado</option>
                    <option value="4">Especialista</option>
                </select>
                <button onclick="removeField(this)" class="ml-2 bg-red-100 text-red-600 px-3 py-1 rounded text-sm hover:bg-red-200 transition">
                    <i class="fas fa-trash"></i>
                </button>
            `;
    container.appendChild(newField);
}

// Adicionar campos de idiomas
function addLanguageField() {
    const container = document.getElementById('languages-container');
    const newField = document.createElement('div');
    newField.className = 'language-item dynamic-field flex items-center mb-2';
    newField.innerHTML = `
                <input type="text" placeholder="Idioma" class="language-name w-1/2 px-3 py-1 border rounded mr-2">
                <select class="language-level w-1/2 px-3 py-1 border rounded">
                    <option value="Básico">Básico</option>
                    <option value="Intermediário">Intermediário</option>
                    <option value="Avançado">Avançado</option>
                    <option value="Fluente">Fluente</option>
                    <option value="Nativo">Nativo</option>
                </select>
                <button onclick="removeField(this)" class="ml-2 bg-red-100 text-red-600 px-3 py-1 rounded text-sm hover:bg-red-200 transition">
                    <i class="fas fa-trash"></i>
                </button>
            `;
    container.appendChild(newField);
}

// Remover campos
function removeField(button) {
    const field = button.closest('.dynamic-field');
    if (field) {
        field.remove();
    }
}

// Gerar o currículo
function generateResume() {
    // Dados pessoais
    document.getElementById('resume-name').textContent = document.getElementById('fullName').value || 'Seu Nome';
    document.getElementById('resume-profession').textContent = document.getElementById('profession').value || 'Sua Profissão';
    document.getElementById('resume-age').textContent = `Idade: ${document.getElementById('age').textContent || '-'} anos`;
    document.getElementById('resume-phone').innerHTML = `<i class="fas fa-phone mr-2"></i>${document.getElementById('phone').value || '(00) 00000-0000'}`;
    document.getElementById('resume-email').innerHTML = `<i class="fas fa-envelope mr-2"></i>${document.getElementById('email').value || 'seu@email.com'}`;
    document.getElementById('resume-address').innerHTML = `<i class="fas fa-map-marker-alt mr-2"></i>${document.getElementById('address').value || 'Sua Cidade, Estado'}`;
    document.getElementById('resume-linkedin').innerHTML = `<i class="fab fa-linkedin mr-2"></i>${document.getElementById('linkedin').value || 'linkedin.com/in/seu-perfil'}`;
    document.getElementById('resume-about').textContent = document.getElementById('about').value || 'Breve descrição sobre você e seus objetivos profissionais.';

    // Formação acadêmica
    const educationContainer = document.getElementById('resume-education');
    educationContainer.innerHTML = '';

    const educationItems = document.querySelectorAll('.education-item');
    educationItems.forEach(item => {
        const course = item.querySelector('.education-course').value;
        const institution = item.querySelector('.education-institution').value;
        const year = item.querySelector('.education-year').value;
        const details = item.querySelector('.education-details').value;

        if (course || institution || year) {
            const educationHTML = `
                        <div class="mb-4">
                            <div class="flex justify-between">
                                <h4 class="font-semibold text-gray-800">${course || 'Curso/Grau'}</h4>
                                <span class="text-gray-500">${year || 'Ano'}</span>
                            </div>
                            <p class="text-gray-600">${institution || 'Instituição de Ensino'}</p>
                            ${details ? `<p class="text-gray-500 text-sm mt-1">${details}</p>` : ''}
                        </div>
                    `;
            educationContainer.innerHTML += educationHTML;
        }
    });

    if (educationContainer.innerHTML === '') {
        educationContainer.innerHTML = '<p class="text-gray-600">Nenhuma formação acadêmica informada</p>';
    }

    // Experiência profissional
    const experienceContainer = document.getElementById('resume-experience');
    experienceContainer.innerHTML = '';

    const experienceItems = document.querySelectorAll('.experience-item');
    experienceItems.forEach(item => {
        const position = item.querySelector('.experience-position').value;
        const company = item.querySelector('.experience-company').value;
        const period = item.querySelector('.experience-period').value;
        const description = item.querySelector('.experience-description').value;

        if (position || company || period) {
            const experienceHTML = `
                        <div class="mb-4">
                            <div class="flex justify-between">
                                <h4 class="font-semibold text-gray-800">${position || 'Cargo'}</h4>
                                <span class="text-gray-500">${period || 'Período'}</span>
                            </div>
                            <p class="text-gray-600">${company || 'Empresa'}</p>
                            ${description ? `<p class="text-gray-500 text-sm mt-1">${description}</p>` : ''}
                        </div>
                    `;
            experienceContainer.innerHTML += experienceHTML;
        }
    });

    if (experienceContainer.innerHTML === '') {
        experienceContainer.innerHTML = '<p class="text-gray-600">Nenhuma experiência profissional informada</p>';
    }

    // Habilidades
    const skillsContainer = document.getElementById('resume-skills');
    skillsContainer.innerHTML = '';

    const skillItems = document.querySelectorAll('.skill-item');
    skillItems.forEach(item => {
        const name = item.querySelector('.skill-name').value;
        const level = item.querySelector('.skill-level').value;
        const levelText = ['', 'Iniciante', 'Intermediário', 'Avançado', 'Especialista'][level];

        if (name) {
            const skillHTML = `<span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">${name} (${levelText})</span>`;
            skillsContainer.innerHTML += skillHTML;
        }
    });

    if (skillsContainer.innerHTML === '') {
        skillsContainer.innerHTML = '<p class="text-gray-600">Nenhuma habilidade informada</p>';
    }

    // Idiomas
    const languagesContainer = document.getElementById('resume-languages');
    languagesContainer.innerHTML = '';

    const languageItems = document.querySelectorAll('.language-item');
    languageItems.forEach(item => {
        const name = item.querySelector('.language-name').value;
        const level = item.querySelector('.language-level').value;

        if (name) {
            const languageHTML = `<p class="text-gray-600">${name}: ${level}</p>`;
            languagesContainer.innerHTML += languageHTML;
        }
    });

    if (languagesContainer.innerHTML === '') {
        languagesContainer.innerHTML = '<p class="text-gray-600">Nenhum idioma informado</p>';
    }

    // Informações adicionais
    const additionalInfo = document.getElementById('additionalInfo').value;
    document.getElementById('resume-additional').innerHTML = additionalInfo ? `<p>${additionalInfo}</p>` : '<p>Prêmios, certificações, projetos relevantes, etc.</p>';

    // Mostrar a visualização
    document.querySelector('.print-area').style.display = 'block';
    document.querySelector('.no-print + .bg-white.rounded-lg').style.display = 'none';
}

// Imprimir o currículo
function printResume() {
    generateResume();
    setTimeout(() => {
        window.print();
    }, 500);
}

// Limpar o formulário
function resetForm() {
    document.querySelectorAll('input, textarea').forEach(element => {
        element.value = '';
    });

    const containers = ['education-container', 'experience-container', 'skills-container', 'languages-container'];
    containers.forEach(id => {
        const container = document.getElementById(id);
        container.innerHTML = '';

        if (id === 'education-container' || id === 'experience-container') {
            if (id === 'education-container') addEducationField();
            if (id === 'experience-container') addExperienceField();
        } else {
            if (id === 'skills-container') addSkillField();
            if (id === 'languages-container') addLanguageField();
        }
    });

    document.getElementById('age').textContent = '-';

    document.querySelector('.print-area').style.display = 'none';
    document.querySelector('.no-print + .bg-white.rounded-lg').style.display = 'block';
}

// Inicializar com um campo em cada seção
window.onload = function () {
    addEducationField();
    addExperienceField();
    addSkillField();
    addLanguageField();
};