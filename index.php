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
    <h1
