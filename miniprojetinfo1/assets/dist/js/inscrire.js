// Recuperer notre Form depuis le DOM.
const form = document.getElementById("myform");
const submitButton = form.querySelector("button");
    
// TODO: Task 1 - Recuperer les elements Passwords 
const passwordInput = document.getElementById("pwd");
const confirmPasswordInput = document.getElementById("cpwd");


// Syntaxe anonyme
const checkPasswords = function () {
    // TODO: Task 2 - Comparer passwordInput value avec confirmPasswordInput value
    const passwordsMatch = passwordInput.value === confirmPasswordInput.value;

    // TODO: Task 3 - Verifier les passwords
    if (passwordsMatch) {
        // Effacer le message d'erreur precedent.
        
        confirmPasswordInput.setCustomValidity("");
    } else {
        // Le formulaire ne sera pas envoyé en cas d'erreur. Un message sera affiché à l'utilisateur
        confirmPasswordInput.setCustomValidity("Vos mots de passe ne correspondent pas. Veuillez retaper le même mot de passe.");
    }
};



const addPasswordInputEventListeners = function () {
    // TODO: Task 4 - Ajouter l' ecouteur d'evenement "input" aux elements passwordInput et confirmPasswordInput.
    //       Appeler la fonction checkPasswords
    passwordInput.addEventListener("input", checkPasswords);
    confirmPasswordInput.addEventListener("input", checkPasswords);
   // submitButton.addEventListener("click",checkPasswords);
};

addPasswordInputEventListeners();



