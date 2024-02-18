from pypasser import reCaptchaV3

reCaptcha_response = reCaptchaV3('https://www.google.com/recaptcha/api2/anchor?ar=1&k=6LdevPgfAAAAADYwit3dtW0Z5iC8K9_uzIHc-0Al&co=aHR0cHM6Ly9wb3J0YWwuZGV0cmFuLnJuLmdvdi5icjo0NDM.&hl=pt-BR&v=vm_YDiq1BiI3a8zfbIPZjtF2&size=invisible&cb=5yo01yuv07ke')

if reCaptcha_response is not None:
    # Faça algo com a resposta aqui
    print(reCaptcha_response)
else:
    print("A resposta retornada é 'None'. Verifique sua implementação da função reCaptchaV3 para garantir que ela esteja retornando um valor válido.")
