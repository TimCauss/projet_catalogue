# import multithreading
import threading

# import time for some sleep
import time

# import urllib as dw pour le téléchargement des images
import urllib.request


# import undetected_chromedriver and selenium
import undetected_chromedriver as browser
from selenium import webdriver

from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.common.by import By
from selenium.common.exceptions import NoSuchElementException
from selenium.webdriver.support.select import Select
from selenium.webdriver.common.keys import Keys

range_start = input('Start: ')
range_end = input('End :')
# Fonction qui rajoute des 0 devant le numéro du pokemon si celui-ci est inférieur à 4 chiffres:


def add_zero(p_numero):
    if len(p_numero) == 1:
        p_numero = "000" + p_numero
    elif len(p_numero) == 2:
        p_numero = "00" + p_numero
    elif len(p_numero) == 3:
        p_numero = "0" + p_numero
    return str(p_numero)

# fonction qui retire tous les zéros en début de chain :


def remove_zero(p_numero):
    while p_numero[0] == '0':
        p_numero = p_numero[1:]
        return p_numero


# fonction qui garde que le mot n d'une chaine de caractère:


def keep_word(s, n):
    return (s.split(" "))[n]

# fonction qui renvoie un boolean en fonction de la présence d'un élement:


def check_exists(xpath, d):
    try:
        d.find_element(By.XPATH, xpath)
    except NoSuchElementException:
        return False
    return True


def check_exists_css(selector, d):
    try:
        d.find_element(By.CSS_SELECTOR, selector)
    except NoSuchElementException:
        return False
    return True

# fonction qui retirer la dernière virgule d'une chaine de caractère:


def remove_last_comma(s):
    if s[-1] == ",":
        s = s[:-1]
    return s

# La fonction de scraping:


def scrapper(range_start, range_end):
    options = webdriver.ChromeOptions()
    options.add_argument("--disable-blink-features=AutomationControlled")
    d = browser.Chrome(options=options, enable_console_log=True)
    wait = WebDriverWait(d, 3, 0.2)
    count = 0

    for i in range(int(range_start), int(range_end)):
        d.implicitly_wait(5)
        evo = ''
        error_evo = False

        while error_evo == False:
            count += 1
            print('Connexion a site Pokemon officiel')
            d.get("https://www.pokemon.com/fr/pokedex")

            if count == 1:
                wait.until(lambda d: d.find_element(
                    By.ID, "onetrust-reject-all-handler")).click()

            time.sleep(0.5)
            if evo != '':
                wait.until(lambda d: d.find_element(
                    By.ID, "searchInput")).send_keys(evo)
                evo = ''
                error_evo = True
            else:
                wait.until(lambda d: d.find_element(
                    By.ID, "searchInput")).send_keys(i)
            time.sleep(0.250)
            d.find_element(By.ID, "searchInput").send_keys(Keys.RETURN)

            time.sleep(0.5)
            wait.until(lambda d: d.find_element(
                By.XPATH, "/html/body/div[4]/section[5]/ul/li[1]/a/img")).click()

            # On récupère les infos du pokemon:
            print('Récupération des infos du pokémon')
            p_numero = keep_word(wait.until(lambda d: d.find_element(
                By.XPATH, "/html/body/div[4]/section[1]/div[2]/div")).text, 2)
            p_numero = remove_zero(p_numero)
            p_nom = keep_word(wait.until(lambda d: d.find_element(
                By.XPATH, "/html/body/div[4]/section[1]/div[2]/div")).text, 0)

            p_description = wait.until(lambda d: d.find_element(
                By.XPATH, "/html/body/div[4]/section[3]/div[2]/div/div[1]")).text

            p_taille = d.find_element(
                By.XPATH, ("//*[contains(text(),'Taille')]/following-sibling::span")).text
            p_poids = d.find_element(
                By.XPATH, ("//*[contains(text(),'Poids')]/following-sibling::span")).text
            p_type = d.find_element(
                By.XPATH, ("//*[contains(text(),'Type')]/following-sibling::ul/li[1]/a")).text
            # On gère le cas où le pokemon n'a pas de second type:
            ptype2_xpath = "//*[contains(text(),'Type')]/following-sibling::ul/li[2]/a"
            if (check_exists(ptype2_xpath, d) == True):
                p_type2 = d.find_element(
                    By.XPATH, ("//*[contains(text(),'Type')]/following-sibling::ul/li[2]/a")).text
            else:
                p_type2 = "Type"

            print(f'Nom: {p_nom}')
            print(f'Numéro: {p_numero}')
            print(f'Description: {p_description}')
            print(f'Taille: {p_taille}')
            print(f'Poids: {p_poids}')
            print(f'Type:  {p_type}, {p_type2}')

            # On gère l'image
            img = d.find_element(
                By.XPATH, "//img[@alt='" + p_nom + "']")
            urllib.request.urlretrieve(img.get_attribute(
                "src"), "/var/www/html/uploads/" + p_nom + ".png")

            # On gère les évo, on créer une boucle de 3:
            p_evo_w = ""
            p_evo = []
            for j in range(1, 4):

                locator = ".evolution-profile > li:nth-child(" + str(
                    j) + ") > a:nth-child(1) > h3:nth-child(2)"

                if (check_exists_css(locator, d) == True):
                    p_evo_w += keep_word(d.find_element(By.CSS_SELECTOR,
                                                        locator).text, 0)
                    print(f'Evolution: {p_evo_w}')
                    p_evo.append(p_evo_w)
                    p_evo_w = ""

            # print(p_evo)
            # if p_nom == p_evo[0]:
            #     evolves_from = False
            # elif p_nom == p_evo[1]:
            #     evolves_from = p_evo[0]
            # elif p_nom == p_evo[2]:
            #     evolves_from = p_evo[1]

            nb_evolutions = len(p_evo)
            for i in range(nb_evolutions):
                if p_nom == p_evo[i]:
                    if i == 0:
                        evolves_from = False
                    else:
                        evolves_from = p_evo[i - 1]
            print(evolves_from)

            if count == 1:
                d.get("http://127.0.0.1:80/profil.php")
                wait.until(lambda d: d.find_element(
                    By.ID, "login-email")).send_keys("jesuisun@bot.fr")
                d.find_element(By.ID, "login-pass").send_keys("123456789")
                time.sleep(0.1)
                d.find_element(By.ID, "submitLogin").click()

            d.get("http://127.0.0.1:80/profil.php")
            d.find_element(
                By.XPATH, "//*[contains(text(),'Ajouter')]").click()
            wait.until(lambda d: d.find_element(By.ID, "nom")).send_keys(p_nom)
            d.find_element(By.ID, "numero").send_keys(p_numero)
            d.find_element(By.ID, "description").send_keys(p_description)
            d.find_element(By.ID, "taille").send_keys(keep_word(p_taille, 0))
            d.find_element(By.ID, "poids").send_keys(keep_word(p_poids, 0))

            if p_type == "Électrik":
                p_type = "Electrik"
            elif (p_type == "Ténèbres"):
                p_type = "Tenebres"

            if p_type2 == "Électrik":
                p_type2 = "Electrik"
            elif (p_type2 == "Fée"):
                p_type2 = "Fee"
            elif (p_type2 == "Ténèbres"):
                p_type2 = "Tenebres"

            type_select = d.find_element(
                By.CSS_SELECTOR, "body > section.form-add-container.px-10.active > div > div.card-body > form > div:nth-child(8) > span")
            type_select.click()

            d.find_element(By.CSS_SELECTOR, "body > section.form-add-container.px-10.active > div > div.card-body > form > div:nth-child(8) > span > span.selection > span > span > textarea").send_keys(p_type)
            d.find_element(By.CSS_SELECTOR, "body > section.form-add-container.px-10.active > div > div.card-body > form > div:nth-child(8) > span > span.selection > span > span > textarea").send_keys(Keys.RETURN)
            if p_type2 != "":
                d.find_element(
                    By.CSS_SELECTOR, "body > section.form-add-container.px-10.active > div > div.card-body > form > div:nth-child(8) > span > span.selection > span > span > textarea").send_keys(p_type2)
                d.find_element(
                    By.CSS_SELECTOR, "body > section.form-add-container.px-10.active > div > div.card-body > form > div:nth-child(8) > span > span.selection > span > span > textarea").send_keys(Keys.RETURN)

            if evolves_from != False:
                d.find_element(By.ID, 'is_evolution').click()
                evo_input = d.find_element(By.NAME, 'evolution_from')
                select_evo = Select(evo_input)
                try:
                    select_evo.select_by_visible_text(evolves_from)
                except NoSuchElementException:
                    p_index = p_evo.index(p_nom)
                    e_index = p_index - 1
                    evo = p_evo[e_index]
                    print("exception catch sur le select de l'évolution")
                    continue
                break
            else:
                break

        # d.find_element(By.ID, "evolutions").send_keys(
        #     remove_last_comma(p_evo))

        d.find_element(By.ID, "p_img").send_keys(
            "/var/www/html/uploads/" + p_nom + ".png")

        d.find_element(By.ID, "submit").submit()

    """         d.find_element(
                By.XPATH, "/html/body/section/div/div[2]/form/div[7]/input").click() """


# Section des threads:
thread = threading.Thread(target=scrapper, args=(
    range_start, range_end))  # fonction de scraping
""" thread2= threading.Thread(target=scrapper, args=(range_start, range_end))#fonction de scraping """

thread.start()  # on lance le thread
""" thread2.start()#on lance le thread """
