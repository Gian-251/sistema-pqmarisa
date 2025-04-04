<?php require_once('template/topomenu.php'); ?>

<body id="ingresso">
    <header> 
        <?php require_once('template/menu.php'); ?>
    </header>

    <main>
        <section>
            <div class="calendario">
                <h2>Selecione uma data para seu ingresso</h2>
                <div class="calendario-container">
                    <div class="calendario-header">
                        <button id="prev-month">Anterior</button>
                        <h3 id="month-year">Mês Ano</h3>
                        <button id="next-month">Próximo</button>
                    </div>
                    <div class="dias-semana">
                        <div>Dom</div>
                        <div>Seg</div>
                        <div>Ter</div>
                        <div>Qua</div>
                        <div>Qui</div>
                        <div>Sex</div>
                        <div>Sáb</div>
                    </div>
                    <div id="calendario-dias" class="calendario-dias">
                        <!-- Os dias serão inseridos via JavaScript -->
                    </div>
                </div>
            </div>

            <div class="ingresso">
                <h2>Selecione a quantidade de ingressos</h2>
                <div class="tipo-ingresso">
                    <span>Ingresso (R$ 10,00)</span>
                    <div class="quantidade">
                        <button class="diminuir">-</button>
                        <input type="number" min="0" value="0" class="qtd-ingresso" data-valor="10.00" data-tipo="ingresso">
                        <button class="aumentar">+</button>
                    </div>
                </div>
                <div class="total-compra">
                    <p>Total: <span id="valor-total">R$ 0,00</span></p>
                    <button id="btn-adicionar">Adicionar ao Carrinho</button>
                </div>
            </div>
        </section>

        <div class="carrinho" style="display:none;">
            <h2>Seu Carrinho</h2>
            <div id="itens-carrinho">
                <!-- Os itens serão inseridos dinamicamente aqui -->
            </div>
            <div class="total-carrinho">
                <h3>Total: <span id="total-carrinho">R$ 0,00</span></h3>
                <button id="btn-finalizar-compra" class="btn-finalizar">Finalizar Compra</button>
            </div>
        </div>
    </main>

    <footer>
        <?php require_once('template/rodape.php'); ?>
    </footer>

    <style>

        .calendario h2, .ingresso h2, .combos h2, .carrinho h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .calendario-container {
            margin-bottom: 30px;
        }

        .calendario-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .calendario-header button {
            background-color: #ff6b00;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .calendario-header button:hover {
            background-color: #e05a00;
        }

        .dias-semana {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            background-color: #f5f5f5;
            padding: 10px 0;
            border-radius: 5px;
        }

        .calendario-dias {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .dia {
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .dia.vazio {
            background-color: transparent;
            cursor: default;
        }

        .dia.indisponivel {
            color: #ccc;
            background-color: #f9f9f9;
            cursor: not-allowed;
        }

        .dia.disponivel {
            background-color: #e8f4ff;
        }

        .dia.disponivel:hover {
            background-color: #c5e1ff;
        }

        .dia.feriado {
            background-color: #ffecb3;
        }

        .dia.feriado:hover {
            background-color: #ffe082;
        }

        .dia.selecionado {
            background-color: #ff6b00;
            color: white;
        }

        .tipo-ingresso, .combo-item {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .combos-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .combo-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .quantidade {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantidade button {
            width: 30px;
            height: 30px;
            background-color: #ff6b00;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .quantidade input {
            width: 50px;
            height: 30px;
            text-align: center;
            margin: 0 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .total-compra, .total-carrinho {
            text-align: center;
            margin-top: 20px;
        }

        .total-compra button, .total-carrinho button {
            background-color: #ff6b00;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
        }

        .item-carrinho {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding: 10px;
        }

        .item-carrinho:last-child {
            border-bottom: none;
        }

        .remover-item {
            background-color: #ff3b30;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calendário
            const calendarioDias = document.getElementById('calendario-dias');
            const monthYearElement = document.getElementById('month-year');
            const prevMonthBtn = document.getElementById('prev-month');
            const nextMonthBtn = document.getElementById('next-month');
            
            let currentDate = new Date();
            let currentMonth = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();
            
            const meses = [
                'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
            ];
            
            const feriados = [
                "01/01/2024", "12/02/2024", "13/02/2024", "29/03/2024", 
                "21/04/2024", "01/05/2024", "30/05/2024", "07/09/2024", 
                "12/10/2024", "02/11/2024", "15/11/2024", "25/12/2024",
                "01/01/2025", "03/03/2025", "04/03/2025", "18/04/2025", 
                "21/04/2025", "01/05/2025", "19/06/2025", "07/09/2025", 
                "12/10/2025", "02/11/2025", "15/11/2025", "25/12/2025"
            ];
            
            function isFeriado(day, month, year) {
                const dataFormatada = `${day.toString().padStart(2, '0')}/${(month + 1).toString().padStart(2, '0')}/${year}`;
                return feriados.includes(dataFormatada);
            }
            
            function gerarCalendario(month, year) {
                calendarioDias.innerHTML = '';
                monthYearElement.textContent = `${meses[month]} ${year}`;
                
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const firstDayIndex = firstDay.getDay();
                const totalDays = lastDay.getDate();
                
                for (let i = 0; i < firstDayIndex; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.classList.add('dia', 'vazio');
                    calendarioDias.appendChild(dayElement);
                }
                
                for (let day = 1; day <= totalDays; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.classList.add('dia');
                    dayElement.textContent = day;
                    
                    const dataCalendario = new Date(year, month, day);
                    const hoje = new Date();
                    hoje.setHours(0, 0, 0, 0);
                    
                    const diaSemana = dataCalendario.getDay();
                    const ehFinalDeSemana = diaSemana === 0 || diaSemana === 6;
                    const ehFeriado = isFeriado(day, month, year);
                    
                    if (dataCalendario < hoje) {
                        dayElement.classList.add('indisponivel');
                    } else if (ehFinalDeSemana || ehFeriado) {
                        if (ehFeriado) {
                            dayElement.classList.add('feriado');
                        } else {
                            dayElement.classList.add('disponivel');
                        }
                        
                        dayElement.addEventListener('click', function() {
                            document.querySelectorAll('.dia.selecionado').forEach(el => {
                                el.classList.remove('selecionado');
                            });
                            
                            this.classList.add('selecionado');
                            
                            const dataSelecionadaFormatada = `${day.toString().padStart(2, '0')}/${(month + 1).toString().padStart(2, '0')}/${year}`;
                            console.log('Data selecionada:', dataSelecionadaFormatada);
                            
                            const event = new CustomEvent('dataSelecionada', { 
                                detail: { 
                                    data: dataSelecionadaFormatada,
                                    dia: day,
                                    mes: month + 1,
                                    ano: year
                                } 
                            });
                            document.dispatchEvent(event);
                        });
                    } else {
                        dayElement.classList.add('indisponivel');
                    }
                    
                    calendarioDias.appendChild(dayElement);
                }
            }
            
            gerarCalendario(currentMonth, currentYear);
            
            prevMonthBtn.addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                gerarCalendario(currentMonth, currentYear);
            });
            
            nextMonthBtn.addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                gerarCalendario(currentMonth, currentYear);
            });
            
            document.addEventListener('dataSelecionada', function(e) {
                console.log('Evento capturado:', e.detail);
            });

            // Controle de ingressos e carrinho
            const diminuirButtons = document.querySelectorAll('.diminuir');
            const aumentarButtons = document.querySelectorAll('.aumentar');
            const inputs = document.querySelectorAll('.qtd-ingresso');
            const valorTotal = document.getElementById('valor-total');
            const btnAdicionar = document.getElementById('btn-adicionar');
            let carrinho = [];

            function calcularTotal() {
                let total = 0;
                inputs.forEach(input => {
                    const valor = parseFloat(input.dataset.valor);
                    total += parseInt(input.value) * valor;
                });
                valorTotal.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
            }

            diminuirButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('.qtd-ingresso');
                    let qtd = parseInt(input.value);
                    if(qtd > 0) {
                        input.value = qtd - 1;
                        calcularTotal();
                    }
                });
            });

            aumentarButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('.qtd-ingresso');
                    let qtd = parseInt(input.value);
                    input.value = qtd + 1;
                    calcularTotal();
                });
            });

            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    if(parseInt(this.value) < 0) {
                        this.value = 0;
                    }
                    calcularTotal();
                });
            });

            btnAdicionar.addEventListener('click', function() {
                const qtd = parseInt(document.querySelector('.qtd-ingresso').value);
                if(qtd > 0) {
                    carrinho.push({
                        tipo: 'Ingresso',
                        quantidade: qtd,
                        valor: 10.00
                    });
                    exibirCarrinho();
                    alert(qtd + ' ingresso(s) adicionado(s) ao carrinho.');
                    document.querySelector('.qtd-ingresso').value = 0;
                    calcularTotal();
                } else {
                    alert('Selecione pelo menos um ingresso.');
                }
            });

            function exibirCarrinho() {
                const divCarrinho = document.querySelector('.carrinho');
                const itensCarrinho = document.getElementById('itens-carrinho');
                const totalCarrinho = document.getElementById('total-carrinho');
                
                itensCarrinho.innerHTML = '';
                let total = 0;
                
                carrinho.forEach((item, index) => {
                    total += item.quantidade * item.valor;
                    const divItem = document.createElement('div');
                    divItem.classList.add('item-carrinho');
                    divItem.innerHTML = `
                        <span><strong>${item.tipo}</strong> - ${item.quantidade} x R$ ${item.valor.toFixed(2).replace('.', ',')}</span>
                        <button class="remover-item" data-index="${index}">Remover</button>
                    `;
                    itensCarrinho.appendChild(divItem);
                });
                
                totalCarrinho.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
                divCarrinho.style.display = 'block';
                
                // Adicionar eventos para remover itens
                document.querySelectorAll('.remover-item').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = parseInt(this.dataset.index);
                        carrinho.splice(index, 1);
                        exibirCarrinho();
                    });
                });
            }

            // Finalizar compra
            document.getElementById('btn-finalizar-compra').addEventListener('click', function() {
                if(carrinho.length === 0) {
                    alert('Seu carrinho está vazio.');
                    return;
                }
                alert('Compra finalizada com sucesso!');
                carrinho = [];
                document.querySelector('.carrinho').style.display = 'none';
                document.getElementById('itens-carrinho').innerHTML = '';
                document.getElementById('total-carrinho').textContent = 'R$ 0,00';
            });
        });
    </script>
</body>
</html>