window.onload = function () {
    addEducationField();
    addExperienceField();
    addSkillField();
    addLanguageField();

    // Aqui também pode adicionar event listeners, ex:
    document.getElementById('birthDate').addEventListener('change', calculateAge);
    document.getElementById('generate-btn').addEventListener('click', () => generateResume(false));
    document.getElementById('print-btn').addEventListener('click', printResume);
    document.getElementById('reset-btn').addEventListener('click', resetForm);
}
