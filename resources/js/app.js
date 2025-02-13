import './bootstrap';
import IMask from 'imask';

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        let sidebar = document.getElementById('sidebar');
        let content = document.getElementById('main-content');
        let userSpan = document.querySelector(".user-menu span"); // Nome do usuário
        let arrow = document.querySelector(".user-menu .arrow");  // Seta
        let userImage = document.querySelector(".user-menu img"); // Imagem do usuário
        let dropdown = document.getElementById("dropdownMenu"); // Dropdown

        if (sidebar.style.width === "70px") {
            // Expandindo
            sidebar.style.width = "250px";
            content.style.marginLeft = "250px";
            content.classList.remove('collapsed');

            setTimeout(() => {
                document.querySelectorAll("#sidebar .nav-link span").forEach(span => {
                    span.style.display = "inline";
                    span.style.opacity = "1";
                });

                if (userSpan) {
                    userSpan.style.display = "inline";
                    userSpan.style.opacity = "1";
                    userSpan.style.width = "auto";
                }
                if (arrow) {
                    arrow.style.display = "inline";
                    arrow.style.opacity = "1";
                }
                if (userImage) {
                    userImage.style.width = "32px";
                    userImage.style.height = "32px";
                }

                // Posição do dropdown no menu expandido
                if (dropdown) {
                    dropdown.style.left = "auto";
                    dropdown.style.right = "0";
                }
            }, 200);
        } else {
            // Colapsando
            sidebar.style.width = "70px";
            content.style.marginLeft = "70px";
            content.classList.add('collapsed');

            document.querySelectorAll("#sidebar .nav-link span").forEach(span => {
                span.style.opacity = "0";
                setTimeout(() => { span.style.display = "none"; }, 200);
            });

            if (userSpan) {
                userSpan.style.opacity = "0";
                userSpan.style.width = "0";
                setTimeout(() => { userSpan.style.display = "none"; }, 200);
            }
            if (arrow) {
                arrow.style.opacity = "0";
                setTimeout(() => { arrow.style.display = "none"; }, 200);
            }
            if (userImage) {
                userImage.style.width = "70px";
                userImage.style.height = "70px";
                userImage.style.borderRadius = "50%";
            }

            // Posição do dropdown no menu colapsado
            if (dropdown) {
                dropdown.style.left = "50px";  // Ajusta para ficar ao lado da imagem
                dropdown.style.right = "auto";
            }
        }
    });
});




document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.grupo-row').forEach(row => {
        row.addEventListener('click', function () {
            const nomeGrupo = this.getAttribute('data-nome');
            const grupoSelecionadoDiv = document.getElementById('grupo-selecionado');

            if (!grupoSelecionadoDiv) {
                console.warn("Elemento #grupo-selecionado não encontrado.");
                return;
            }

            grupoSelecionadoDiv.innerText = `Grupo Selecionado: ${nomeGrupo}`;

            // Dispara o evento no Livewire com o nome do grupo selecionado
            if (window.Livewire && typeof Livewire.dispatch === 'function') {
                Livewire.dispatch('grupoSelecionado', { nome: nomeGrupo });
            } else {
                console.error("Livewire não foi carregado corretamente.");
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var cnpjElement = document.getElementById('cnpj');
    if (cnpjElement) {
        var cnpjMaskOptions = {
            mask: '00.000.000/0000-00'
        };
        var cnpjMask = IMask(cnpjElement, cnpjMaskOptions);
    } else {
        console.warn("Elemento #cnpj não encontrado.");
    }

    var cpfElement = document.getElementById('cpf');
    if (cpfElement) {
        var cpfMaskOptions = {
            mask: '000.000.000-00'
        };
        var cpfMask = IMask(cpfElement, cpfMaskOptions);
    } else {
        console.warn("Elemento #cpf não encontrado.");
    }

    var emailElement = document.getElementById('email');
    if (emailElement) {
        var emailMaskOptions = {
            mask: /^\S*@?\S*$/
        };
        var emailMask = IMask(emailElement, emailMaskOptions);
    } else {
        console.warn("Elemento #email não encontrado.");
    }
});

// USUARIO

document.addEventListener("DOMContentLoaded", function () {
    const userMenu = document.getElementById("userMenu");
    const dropdownMenu = document.getElementById("dropdownMenu");

    userMenu.addEventListener("click", function (event) {
        event.stopPropagation(); // Evita que o clique feche imediatamente
        dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        userMenu.classList.toggle("active");
    });

    document.addEventListener("click", function (event) {
        if (!userMenu.contains(event.target)) {
            dropdownMenu.style.display = "none";
            userMenu.classList.remove("active");
        }
    });
});