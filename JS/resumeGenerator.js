function generateResume(printTrue) {
    // Dados pessoais
    document.getElementById('resume-name').textContent = document.getElementById('fullName').value || 'Seu Nome';
    document.getElementById('resume-profession').textContent = document.getElementById('profession').value || 'Sua Profissão';
    document.getElementById('resume-age').textContent = `Idade: ${document.getElementById('age').textContent || '-'} anos`;
    document.getElementById('resume-phone').innerHTML = `<i class="fas fa-phone mr-2"></i>${document.getElementById('phone').value || '(00) 00000-0000'}`;
    document.getElementById('resume-email').innerHTML = `<i class="fas fa-envelope mr-2"></i>${document.getElementById('email').value || 'seu@email.com'}`;
    document.getElementById('resume-address').innerHTML = `<i class="fas fa-map-marker-alt mr-2"></i>${document.getElementById('address').value || 'Sua Cidade, Estado'}`;
    document.getElementById('resume-linkedin').innerHTML = `<i class="fab fa-linkedin mr-2"></i>${document.getElementById('linkedin').value || 'linkedin.com/in/seu-perfil'}`;
    document.getElementById('resume-about').textContent = document.getElementById('about').value || 'Breve descrição sobre você e seus objetivos profissionais.';

    // Formação, Experiência, Habilidades e Idiomas
    generateEducation();
    generateExperience();
    generateSkills();
    generateLanguages();

    // Informações adicionais
    const additionalInfo = document.getElementById('additionalInfo').value;
    document.getElementById('resume-additional').innerHTML = additionalInfo ? `<p>${additionalInfo}</p>` : '<p>Prêmios, certificações, projetos relevantes, etc.</p>';

    document.querySelector('.print-area').style.display = 'block';

    if (printTrue) {
        const noPrint = document.querySelectorAll('.no-print');
        const tela = document.querySelector('#printTel');
        noPrint.forEach(el => el.style.display = 'none');
        tela.style.justifyContent = 'center';
    }
}

function printResume() {
    generateResume(true);
    setTimeout(() => window.print(), 500);
}

// Funções auxiliares para cada seção (educação, experiência etc.)
function generateEducation() { /* mesmo código da parte de educação */ }
function generateExperience() { /* mesmo código da parte de experiência */ }
function generateSkills() { /* mesmo código da parte de skills */ }
function generateLanguages() { /* mesmo código da parte de idiomas */ }
