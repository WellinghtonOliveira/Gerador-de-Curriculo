<?php
// Se o formulário foi enviado, processa os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $fullName = $_POST['fullName'] ?? '';
    $profession = $_POST['profession'] ?? '';
    $birthDate = $_POST['birthDate'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $linkedin = $_POST['linkedin'] ?? '';
    $about = $_POST['about'] ?? '';
    $additionalInfo = $_POST['additionalInfo'] ?? '';

    // Calcula idade a partir da data de nascimento
    function calculateAge($birthDate) {
        $birth = new DateTime($birthDate);
        $today = new DateTime('today');
        return $birth->diff($today)->y;
    }
    $age = $birthDate ? calculateAge($birthDate) : '-';

    // Receber os arrays de campos dinâmicos (formação, experiência, habilidades e idiomas)
    $education = $_POST['education'] ?? [];
    $experience = $_POST['experience'] ?? [];
    $skills = $_POST['skills'] ?? [];
    $languages = $_POST['languages'] ?? [];

    // Função para escapar dados (segurança)
    function h($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gerador de Currículo Profissional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans">
<div class="container mx-auto px-4 py-8">

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <!-- Exibe o currículo gerado no backend -->
    <div class="bg-white p-8 rounded-lg shadow-lg print-area">
        <div class="flex justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800"><?= h($fullName) ?: 'Seu Nome' ?></h1>
                <h2 class="text-xl text-blue-600"><?= h($profession) ?: 'Sua Profissão' ?></h2>
                <p class="text-gray-500 text-sm">Idade: <?= h($age) ?> anos</p>
            </div>
            <div class="text-right">
                <p class="text-gray-600"><i class="fas fa-phone mr-2"></i><?= h($phone) ?: '(00) 00000-0000' ?></p>
                <p class="text-gray-600"><i class="fas fa-envelope mr-2"></i><?= h($email) ?: 'seu@email.com' ?></p>
                <p class="text-gray-600"><i class="fas fa-map-marker-alt mr-2"></i><?= h($address) ?: 'Sua Cidade, Estado' ?></p>
                <p class="text-gray-600"><i class="fab fa-linkedin mr-2"></i><?= h($linkedin) ?: 'linkedin.com/in/seu-perfil' ?></p>
            </div>
        </div>

        <section class="mb-8">
            <h3 class="text-xl font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">
                <i class="fas fa-user mr-2"></i>Sobre
            </h3>
            <p class="text-gray-600"><?= nl2br(h($about)) ?: 'Breve descrição sobre você e seus objetivos profissionais.' ?></p>
        </section>

        <section class="mb-8">
            <h3 class="text-xl font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">
                <i class="fas fa-graduation-cap mr-2"></i>Formação Acadêmica
            </h3>
            <?php if (!empty($education)): ?>
                <?php foreach ($education as $edu): ?>
                    <div class="mb-4">
                        <div class="flex justify-between font-semibold text-gray-800">
                            <span><?= h($edu['course'] ?? '') ?></span>
                            <span class="text-gray-500"><?= h($edu['year'] ?? '') ?></span>
                        </div>
                        <p class="text-gray-600"><?= h($edu['institution'] ?? '') ?></p>
                        <p class="text-gray-500 text-sm mt-1"><?= nl2br(h($edu['details'] ?? '')) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600">Nenhuma formação adicionada.</p>
            <?php endif; ?>
        </section>

        <section class="mb-8">
            <h3 class="text-xl font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">
                <i class="fas fa-briefcase mr-2"></i>Experiência Profissional
            </h3>
            <?php if (!empty($experience)): ?>
                <?php foreach ($experience as $exp): ?>
                    <div class="mb-4">
                        <div class="flex justify-between font-semibold text-gray-800">
                            <span><?= h($exp['position'] ?? '') ?></span>
                            <span class="text-gray-500"><?= h($exp['period'] ?? '') ?></span>
                        </div>
                        <p class="text-gray-600"><?= h($exp['company'] ?? '') ?></p>
                        <p class="text-gray-500 text-sm mt-1"><?= nl2br(h($exp['description'] ?? '')) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600">Nenhuma experiência adicionada.</p>
            <?php endif; ?>
        </section>

        <section class="mb-8">
            <h3 class="text-xl font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">
                <i class="fas fa-tools mr-2"></i>Habilidades
            </h3>
            <?php if (!empty($skills)): ?>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($skills as $skill): ?>
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                            <?= h($skill['name'] ?? '') ?> (<?= h($skill['level'] ?? '') ?>)
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-600">Nenhuma habilidade adicionada.</p>
            <?php endif; ?>
        </section>

        <section class="mb-8">
            <h3 class="text-xl font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">
                <i class="fas fa-language mr-2"></i>Idiomas
            </h3>
            <?php if (!empty($languages)): ?>
                <?php foreach ($languages as $lang): ?>
                    <p class="text-gray-600"><?= h($lang['name'] ?? '') ?>: <?= h($lang['level'] ?? '') ?></p>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600">Nenhum idioma adicionado.</p>
            <?php endif; ?>
        </section>

        <section>
            <h3 class="text-xl font-semibold border-b border-gray-200 pb-2 mb-4 text-gray-700">
                <i class="fas fa-star mr-2"></i>Informações Adicionais
            </h3>
            <p class="text-gray-600"><?= nl2br(h($additionalInfo)) ?: 'Prêmios, certificações, projetos relevantes, etc.' ?></p>
        </section>

        <div class="mt-6 flex gap-4 justify-center">
            <button onclick="window.print()" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition flex items-center">
                <i class="fas fa-print mr-2"></i> Imprimir
            </button>
            <a href="<?= $_SERVER['PHP_SELF'] ?>" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition flex items-center">
                <i class="fas fa-redo mr-2"></i> Voltar
            </a>
        </div>
    </div>

<?php else: ?>
    <!-- Formulário para preencher -->
    <h1 class="text-4xl font-bold text-center text-gray-700 mb-12">Gerador de Currículo Profissional</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto space-y-6">
        <!-- Dados básicos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="fullName" class="block text-gray-700 font-semibold mb-1">Nome Completo</label>
                <input required type="text" id="fullName" name="fullName" placeholder="Seu nome completo" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="profession" class="block text-gray-700 font-semibold mb-1">Profissão</label>
                <input required type="text" id="profession" name="profession" placeholder="Sua profissão" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="birthDate" class="block text-gray-700 font-semibold mb-1">Data de Nascimento</label>
                <input type="date" id="birthDate" name="birthDate" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">E-mail</label>
                <input type="email" id="email" name="email" placeholder="seu@email.com" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="phone" class="block text-gray-700 font-semibold mb-1">Telefone</label>
                <input type="tel" id="phone" name="phone" placeholder="(00) 00000-0000" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
        </div>

        <div>
            <label for="address" class="block text-gray-700 font-semibold mb-1">Endereço</label>
            <input type="text" id="address" name="address" placeholder="Rua, Número, Bairro, Cidade" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
            <label for="linkedin" class="block text-gray-700 font-semibold mb-1">LinkedIn</label>
            <input type="url" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/seu-perfil" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
            <label for="about" class="block text-gray-700 font-semibold mb-1">Sobre</label>
            <textarea id="about" name="about" rows="4" placeholder="Fale sobre você e seus objetivos profissionais" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <!-- Campos dinâmicos: Formação -->
        <div id="educationContainer" class="mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Formação Acadêmica</h2>
            <div class="education-entry space-y-4 mb-4 border p-4 rounded bg-gray-50">
                <input type="text" name="education[0][course]" placeholder="Curso" class="w-full border border-gray-300 rounded px-3 py-2" />
                <input type="text" name="education[0][institution]" placeholder="Instituição" class="w-full border border-gray-300 rounded px-3 py-2 mt-2" />
                <input type="text" name="education[0][year]" placeholder="Ano de Conclusão" class="w-full border border-gray-300 rounded px-3 py-2 mt-2" />
                <textarea name="education[0][details]" placeholder="Descrição (opcional)" class="w-full border border-gray-300 rounded px-3 py-2 mt-2"></textarea>
            </div>
        </div>
        <button type="button" id="addEducation" class="mb-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">+ Adicionar Formação</button>

        <!-- Campos dinâmicos: Experiência -->
        <div id="experienceContainer" class="mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Experiência Profissional</h2>
            <div class="experience-entry space-y-4 mb-4 border p-4 rounded bg-gray-50">
                <input type="text" name="experience[0][position]" placeholder="Cargo" class="w-full border border-gray-300 rounded px-3 py-2" />
                <input type="text" name="experience[0][company]" placeholder="Empresa" class="w-full border border-gray-300 rounded px-3 py-2 mt-2" />
                <input type="text" name="experience[0][period]" placeholder="Período (ex: Jan 2020 - Dez 2022)" class="w-full border border-gray-300 rounded px-3 py-2 mt-2" />
                <textarea name="experience[0][description]" placeholder="Descrição das atividades" class="w-full border border-gray-300 rounded px-3 py-2 mt-2"></textarea>
            </div>
        </div>
        <button type="button" id="addExperience" class="mb-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">+ Adicionar Experiência</button>

        <!-- Campos dinâmicos: Habilidades -->
        <div id="skillsContainer" class="mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Habilidades</h2>
            <div class="skills-entry flex gap-4 mb-4">
                <input type="text" name="skills[0][name]" placeholder="Habilidade" class="border border-gray-300 rounded px-3 py-2 flex-grow" />
                <select name="skills[0][level]" class="border border-gray-300 rounded px-3 py-2 w-40">
                    <option value="">Nível</option>
                    <option value="Básico">Básico</option>
                    <option value="Intermediário">Intermediário</option>
                    <option value="Avançado">Avançado</option>
                    <option value="Expert">Expert</option>
                </select>
            </div>
        </div>
        <button type="button" id="addSkill" class="mb-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">+ Adicionar Habilidade</button>

        <!-- Campos dinâmicos: Idiomas -->
        <div id="languagesContainer" class="mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Idiomas</h2>
            <div class="languages-entry flex gap-4 mb-4">
                <input type="text" name="languages[0][name]" placeholder="Idioma" class="border border-gray-300 rounded px-3 py-2 flex-grow" />
                <select name="languages[0][level]" class="border border-gray-300 rounded px-3 py-2 w-40">
                    <option value="">Nível</option>
                    <option value="Básico">Básico</option>
                    <option value="Intermediário">Intermediário</option>
                    <option value="Avançado">Avançado</option>
                    <option value="Fluente">Fluente</option>
                    <option value="Nativo">Nativo</option>
                </select>
            </div>
        </div>
        <button type="button" id="addLanguage" class="mb-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">+ Adicionar Idioma</button>

        <div>
            <label for="additionalInfo" class="block text-gray-700 font-semibold mb-1">Informações Adicionais</label>
            <textarea id="additionalInfo" name="additionalInfo" rows="4" placeholder="Prêmios, certificações, projetos, etc." class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition flex items-center justify-center">
            <i class="fas fa-file-pdf mr-2"></i> Gerar Currículo
        </button>
    </form>
<?php endif; ?>

</div>

<script>
// Função para duplicar campos dinâmicos (formação, experiência, habilidades, idiomas)

function addEntry(containerId, entryClass, templateHTML) {
    const container = document.getElementById(containerId);
    const count = container.querySelectorAll(`.${entryClass}`).length;
    const newIndex = count;
    const newEntry = document.createElement('div');
    newEntry.classList.add(entryClass);
    newEntry.classList.add('mb-4');
    newEntry.classList.add('border');
    newEntry.classList.add('p-4');
    newEntry.classList.add('rounded');
    newEntry.classList.add('bg-gray-50');

    // Ajusta os nomes dos inputs para o índice correto
    newEntry.innerHTML = templateHTML.replace(/\[0\]/g, `[${newIndex}]`);

    container.appendChild(newEntry);
}

document.getElementById('addEducation').addEventListener('click', () => {
    const template = `
        <input type="text" name="education[0][course]" placeholder="Curso" class="w-full border border-gray-300 rounded px-3 py-2" />
        <input type="text" name="education[0][institution]" placeholder="Instituição" class="w-full border border-gray-300 rounded px-3 py-2 mt-2" />
        <input type="text" name="education[0][year]" placeholder="Ano de Conclusão" class="w-full border border-gray-300 rounded px-3 py-2 mt-2" />
        <textarea name="education[0][details]" placeholder="Descrição (opcional)" class="w-full border border-gray-300 rounded px-3 py-2 mt-2"></textarea>
    `;
    addEntry('educationContainer', 'education-entry', template);
});

document.getElementById('addExperience').addEventListener('click', () => {
    const template = `
        <input type="text" name="experience[0][position]" placeholder="Cargo" class="w-full border border-gray-300 rounded px-3 py-2" />
        <input type="text" name="experience[0][company]" placeholder="Empresa" class="w-full border border-gray-300 rounded px-3 py-2 mt-2" />
        <input type="text" name="experience[0][period]" placeholder="Período (ex: Jan 2020 - Dez 2022)" class="w-full border border-gray-300 rounded px-3 py-2 mt-2" />
        <textarea name="experience[0][description]" placeholder="Descrição das atividades" class="w-full border border-gray-300 rounded px-3 py-2 mt-2"></textarea>
    `;
    addEntry('experienceContainer', 'experience-entry', template);
});

document.getElementById('addSkill').addEventListener('click', () => {
    const template = `
        <input type="text" name="skills[0][name]" placeholder="Habilidade" class="border border-gray-300 rounded px-3 py-2 flex-grow" />
        <select name="skills[0][level]" class="border border-gray-300 rounded px-3 py-2 w-40">
            <option value="">Nível</option>
            <option value="Básico">Básico</option>
            <option value="Intermediário">Intermediário</option>
            <option value="Avançado">Avançado</option>
            <option value="Expert">Expert</option>
        </select>
    `;
    addEntry('skillsContainer', 'skills-entry', template);
});

document.getElementById('addLanguage').addEventListener('click', () => {
    const template = `
        <input type="text" name="languages[0][name]" placeholder="Idioma" class="border border-gray-300 rounded px-3 py-2 flex-grow" />
        <select name="languages[0][level]" class="border border-gray-300 rounded px-3 py-2 w-40">
            <option value="">Nível</option>
            <option value="Básico">Básico</option>
            <option value="Intermediário">Intermediário</option>
            <option value="Avançado">Avançado</option>
            <option value="Fluente">Fluente</option>
            <option value="Nativo">Nativo</option>
        </select>
    `;
    addEntry('languagesContainer', 'languages-entry', template);
});
</script>

</body>
</html>
