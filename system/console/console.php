#!/usr/bin/php
<?php
$console = new Console($argc, $argv);

class Console {
    //Attribute
    const NORMAL            = '0';
    const BOLD              = '1';
    const UNDERLINE         = '4';
    const FLASHING          = '5';
    const INVERTED_COLORS   = '7';
    const Invisible         = '8';
    //Text color
    const BLACK             = '30';
    const RED               = '31';
    const GREEN             = '32';
    const YELLOW            = '33';
    const DARK_BLUE         = '34';
    const PURPLE            = '35';
    const BLUE              = '36';
    const WHITE             = '37';
    //Bg color
    const BG_BLACK          = '40';
    const BG_RED            = '41';
    const BG_GREEN          = '42';
    const BG_YELLOW         = '43';
    const BG_DARK_BLUE      = '44';
    const BG_PURPLE         = '45';
    const BG_BLUE           = '46';
    const BG_WHITE          = '47';
    //PATH
    const DEFAULT_PATH      = 'API/Controller/';
    const DEFAULT_NAMESPACE = 'API\Controller';


    public function __construct($argc, $argv) {
        if ($argv[1] == 'MakeController' && $argc == 2) {
            $this->MakeController();
        } else {
            echo $argv[1];
        }
    }

    final public function format(array $style_text, $text){
        $style = array();

        if(key_exists('attribute', $style_text)){
            $style[] += $style_text['attribute'];
        }
        if(key_exists('color', $style_text)){
            $style[] += $style_text['color'];
        }
        if(key_exists('bg_color', $style_text)){
            $style[] += $style_text['bg_color'];
        }

        if(count($style) > 1){
            $format = "\x1b[".implode(';', $style)."m".$text;
        } else {
            $format = "\x1b[".$style[0]."m".$text;
        }
            $format .= "\x1b[0m";

        return $format;
    }

    final private function MakeController (){

        $fullPath = $this->setControllerPath();

        $name = $this->setControllerName($fullPath);

        $namespace = $this->setControllerNamespace();

        $controller = $this->createFileAndDirController($fullPath, $name);



        $text = "<?php \n\nnamespace $namespace;\n\nclass $name\n{\n\tpublic function default()\n\t{\n\t\techo \"Hello world\";\n\t}\n}";
        fwrite($controller, $text);

        fclose($controller);

        echo $this->format( ['bg_color' => self::BG_GREEN, 'color'=>self::BLACK],'Controller created successfully')."\n";
    }

    private function setControllerNamespace(){
        echo $this->format(['color'=>self::RED],
            "\nЗадайте пространство имён контроллера(нажмите ENTER \nчтобы пропустить, будет задано namespace API\Controller): ");

        $namespace = trim(fgets(STDIN));

        if(!empty($namespace)){
            $namespace = self::DEFAULT_NAMESPACE.'\\'.$namespace;
            echo $this->format( ['color'=>self::BLUE],
                'namespace '.$this->format( ['color'=>self::GREEN], $namespace."\n"));

            return $namespace;
        } else{
            echo $this->format( ['color'=>self::BLUE],'namespace '.self::DEFAULT_NAMESPACE."\n");

            return self::DEFAULT_NAMESPACE;
        }
    }

    private function setControllerPath(){
        $default_Path = self::DEFAULT_PATH;

        echo $this->format( ['color'=>self::RED],
            "\nЗадайте путь контроллера(нажмите ENTER чтобы пропустить, \nфайл будет создан в API/Controller/): ");

        $path = trim(fgets(STDIN)).'/';

        if(!empty($path)){
            echo $this->format( ['color'=>self::BLUE],
                $default_Path.$this->format( ['color'=>self::GREEN], trim($path,'/')."\n"));

            return $default_Path.$path;
        } else{
            echo $this->format( ['color'=>self::BLUE],$default_Path."\n");

            return $default_Path;
        }
    }

    private function setControllerName($fullPath){
        echo $this->format(['color'=>self::RED] ,"\nЗадайте имя создаваемого контроллера: ");
        $name = trim(fgets(STDIN));
        if(!file_exists($fullPath.$name.'.php') || !file_exists($fullPath.$name.'.php')){
            echo $this->format( ['color'=>self::GREEN], $name);

            return $name;
        } else {
            echo $this->format( ['bg_color'=>self::BG_RED, 'color'=>self::BLACK],
                "File with name ".
                $this->format( ['color'=>self::DARK_BLUE, 'attribute' => self::UNDERLINE],$name)
                .$this->format( ['bg_color'=>self::BG_RED, 'color'=>self::BLACK], " is already exits"));

            return $this->setControllerName($fullPath);
        }
    }

    private function createFileAndDirController($fullPath, $name){
        if(!file_exists($fullPath)){
            $subfolder = explode('/', $fullPath, -1);
            $lim = count($subfolder);
            if($lim > 3) {
                mkdir($fullPath, 0777, true);
            } else {
                mkdir($fullPath);
            }
            return $this->createFileAndDirController($fullPath, $name);
        } else {
            return fopen($fullPath . $name.'.php', 'w');
        }

    }
}