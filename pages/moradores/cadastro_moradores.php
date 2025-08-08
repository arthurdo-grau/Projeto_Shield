<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Moradores - ShieldTech</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/validation.css">
    <link rel="stylesheet" href="../../css/cpf-validation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php
    include("../../conectarbd.php");
    
    // Processar formulário se foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
        $cpf = mysqli_real_escape_string($conn, $_POST["cpf"]);
        $rg = mysqli_real_escape_string($conn, $_POST["rg"]);
        $data_nascimento = mysqli_real_escape_string($conn, $_POST["data_nascimento"]);
        $sexo = mysqli_real_escape_string($conn, $_POST["sexo"]);
        $telefone = mysqli_real_escape_string($conn, $_POST["telefone"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $bloco = mysqli_real_escape_string($conn, $_POST["bloco"]);
        $torre = mysqli_real_escape_string($conn, $_POST["torre"]);
        $andar = mysqli_real_escape_string($conn, $_POST["andar"]);
        $veiculo = mysqli_real_escape_string($conn, $_POST["veiculo"]);
        $animais = mysqli_real_escape_string($conn, $_POST["animais"]);
        $data_cadastro = date('Y-m-d H:i:s');
        
        // Validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Email inválido! Por favor, digite um email válido.');</script>";
        } else {
            // Verificar se email já existe
            $verificar_email = mysqli_query($conn, "SELECT * FROM tb_moradores WHERE email = '$email'");
            if (mysqli_num_rows($verificar_email) > 0) {
                echo "<script>alert('Este email já está cadastrado!');</script>";
            } else {
                // Inserir morador
                $sql = "INSERT INTO tb_moradores (nome, cpf, rg, data_nascimento, sexo, telefone, email, bloco, torre, andar, veiculo, animais, foto, data_cadastro) 
                        VALUES ('$nome', '$cpf', '$rg', '$data_nascimento', '$sexo', '$telefone','$email', '$bloco', '$torre', '$andar', '$veiculo', '$animais', '$foto', '$data_cadastro')";

                if (mysqli_query($conn, $sql)) {
                    $id_morador = mysqli_insert_id($conn);
                    
                    
                        
                }
            }
        }
    }
    ?>

<header>
        <nav>
            <div class="logo">
                <h1><i class="fas fa-shield"></i> ShieldTech</h1>
            </div>
            <ul class="menu">
                <li><a href="../../index.php"><i class="fas fa-home"></i> Início</a></li>
                <li><a href="../visitantes/visitantes.php"><i class="fas fa-user-friends"></i> Visitantes</a></li>
                <li><a href="../relatorios/relatorios.php"><i class="fas fa-chart-bar"></i> Relatórios</a></li>
                <li><a href="../reservas/reservas.php"><i class="fas fa-calendar"></i> Reservas</a></li>
                <li><a href="../encomendas/cadastro_encomendas.php"><i class="fas fa-box"></i> Encomendas</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn"><i class="fas fa-gear"></i> Cadastros</a>
                    <div class="dropdown-content">
                        <a href="../moradores/cadastro_moradores.php">Moradores</a>
                        <a href="../funcionarios/cadastro_funcionarios.php">Funcionários</a>
                        <a href="../cargos/cadastro_cargos.php">Cargos</a>
                        <a href="../animais/cadastro_animais.php">Animais</a>
                        <a href="../veiculos/cadastro_veiculos.php">Veículos</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Gestão de Moradores</h2>

        <div class="form-grid">
            <section class="form-section">
                <h3>Cadastro de Morador</h3>
                <form method="post" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nome">Nome Completo:</label>
                            <input type="text" id="nome" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="cpf">CPF:</label>
                            <div class="cpf-validation">
                                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                                <span class="validation-icon" id="cpf-icon"></span>
                            </div>
                            <div class="cpf-error" id="cpf-error"></div>
                            <div class="cpf-tooltip">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptext">
                                    Digite um CPF válido. O sistema verificará:<br>
                                    • Formato correto (11 dígitos)<br>
                                    • Dígitos verificadores válidos<br>
                                    • Se já não está cadastrado<br>
                                    Exemplo: 123.456.789-00
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="rg">RG:</label>
                            <input type="text" id="rg" name="rg" required>
                        </div>

                        <div class="form-group">
                            <label for="data_nascimento">Data de Nascimento:</label>
                            <input type="date" id="data_nascimento" name="data_nascimento" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select id="sexo" name="sexo" required>
                                <option value="">Selecione</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <div class="email-validation">
                            <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
                            <span class="validation-icon" id="email-icon"></span>
                        </div>
                        <div class="email-error" id="email-error"></div>
                        <div class="email-tooltip">
                            <i class="fas fa-info-circle"></i>
                            <span class="tooltiptext">
                                Digite um email válido. Exemplos:<br>
                                • usuario@gmail.com<br>
                                • nome@empresa.com.br<br>
                                • contato@dominio.org
                            </span>
                        </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="bloco">Bloco:</label>
                            <input type="text" id="bloco" name="bloco" required>
                        </div>

                        <div class="form-group">
                            <label for="torre">Torre:</label>
                            <input type="text" id="torre" name="torre">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="andar">Andar:</label>
                            <input type="text" id="andar" name="andar">
                        </div>



                    <div class="form-group">
                            <label for="veiculo">Veículo:</label>
                        <input type="hidden" id="veiculo" name="veiculo" value="Não possui">
                        </div>
                    </div>

                </div>
                <!-- Checkbox para animal -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="tem_animal">
                            <input type="checkbox" id="tem_animal" name="animais" value="sim" onchange="toggleAnimalForm()"> 
                            Possui animal de estimação?
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label for="tem_veiculo">
                            <input type="checkbox" id="tem_veiculo" name="tem_veiculo" value="1" onchange="toggleVeiculoInfo()"> 
                            Possui veículo?
                        </label>
                    </div>
                </div>

                <div id="veiculo-info" style="display: none; background: #e8f4fd; padding: 1rem; border-radius: 0.5rem; margin: 1rem 0; border-left: 4px solid #3498db;">
                    <p style="margin: 0; color: #2c3e50;">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Informação:</strong> Para cadastrar os detalhes do veículo (placa, modelo, cor), 
                        acesse o menu <strong>Cadastros > Veículos</strong> após salvar o morador.
                    </p>
                </div>


                    
                    
                </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i> Cadastrar Morador
                        </button>
                        <a href="consultar_moradores.php" class="btn-secondary">
                            <i class="fas fa-list"></i> Ver Moradores
                        </a>
                    </div>
                </form>
            </section>

            <section class="info-section">
                <h3>Acesso Rápido</h3>
                <div class="quick-actions">
                    <a href="../animais/cadastro_animais.php" class="quick-action-card">
                        <i class="fas fa-paw"></i>
                        <h4>Cadastrar Animal</h4>
                        <p>Registre animais de estimação dos moradores</p>
                    </a>
                    
                    <a href="../funcionarios/cadastro_funcionarios.php" class="quick-action-card">
                        <i class="fas fa-user-tie"></i>
                        <h4>Cadastrar Funcionário</h4>
                        <p>Adicione novos funcionários ao sistema</p>
                    </a>
                    
                    <a href="../visitantes/visitantes.php" class="quick-action-card">
                        <i class="fas fa-user-friends"></i>
                        <h4>Registrar Visitante</h4>
                        <p>Controle de acesso de visitantes</p>
                    </a>


                    
                    </div>
                </div>

                <div class="stats-section">
                    <h4>Estatísticas</h4>
                    <?php
                    $total_moradores = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_moradores"));
                    $total_blocos = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT bloco FROM tb_moradores WHERE bloco IS NOT NULL AND bloco != ''"));
                    $com_veiculos = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_moradores WHERE veiculo IS NOT NULL AND veiculo != ''"));
                    ?>
                    
                    <div class="stat-item">
                        <span class="stat-number"><?= $total_moradores ?></span>
                        <span class="stat-label">Total de Moradores</span>
                    </div>
                    
                    <div class="stat-item">
                        <span class="stat-number"><?= $total_blocos ?></span>
                        <span class="stat-label">Blocos Ocupados</span>
                    </div>
                    
                    <div class="stat-item">
                        <span class="stat-number"><?= $com_veiculos ?></span>
                        <span class="stat-label">Com Veículos</span>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 ShieldTech. Todos os direitos reservados.</p>
    </footer>

    <script src="../../js/validation.js"></script>
    <script src="../../js/cpf-validator.js"></script>
    <script>
        // Máscara para telefone
        document.getElementById('telefone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
                e.target.value = value;
            }
        });

        // Configurar validação de email em tempo real
        document.addEventListener('DOMContentLoaded', () => {
            EmailValidator.setupEmailValidation('email', 'email-error');
            CPFValidator.setupCompleteValidation('cpf', 'cpf-error', 'moradores');
        });
        
        // Função para mostrar/ocultar informação sobre veículo
        function toggleVeiculoInfo() {
            const checkbox = document.getElementById('tem_veiculo');
            const veiculoInfo = document.getElementById('veiculo-info');
            const veiculoSelect = document.getElementById('veiculo');
            
            if (checkbox.checked) {
                veiculoInfo.style.display = 'block';
                veiculoSelect.value = 'Possui';
            } else {
                veiculoInfo.style.display = 'none';
                veiculoSelect.value = 'Não possui';
            }
        }
        
        // Função para mostrar/ocultar formulário de animal
        function toggleAnimalForm() {
            const checkbox = document.getElementById('tem_animal');
            const animalForm = document.getElementById('animal-form-section');
            
            if (checkbox.checked) {
                animalForm.style.display = 'block';
                animalForm.style.animation = 'fadeIn 0.3s ease-in';
                
                // Tornar campos obrigatórios quando visíveis
                document.getElementById('nome_animal').required = true;
                document.getElementById('tipo_animal').required = true;
                document.getElementById('porte_animal').required = true;
            } else {
                animalForm.style.display = 'none';
                
                // Remover obrigatoriedade e limpar campos
                document.getElementById('nome_animal').required = false;
                document.getElementById('tipo_animal').required = false;
                document.getElementById('porte_animal').required = false;
                
                // Limpar todos os campos do animal
                document.getElementById('nome_animal').value = '';
                document.getElementById('tipo_animal').value = '';
                document.getElementById('porte_animal').value = '';
                document.getElementById('observacoes_animal').value = '';
            }
        }
    </script>
</body>
</html>