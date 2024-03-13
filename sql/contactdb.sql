-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-02-27 18:29:34
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `surumie`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `contactdb`
--

CREATE TABLE `contactdb` (
  `contid` int(10) UNSIGNED NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `contname` varchar(50) NOT NULL,
  `contemail` varchar(255) NOT NULL,
  `conttext` text NOT NULL,
  `displayflag` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- テーブルのデータのダンプ `contactdb`
--

INSERT INTO `contactdb` (`contid`, `id`, `contname`, `contemail`, `conttext`, `displayflag`) VALUES
(1, 0, 'シャア・アズナブル', 'red_comet@zionic.co.jp', '地球の引力にひかれ大気圏に突入すれば、ザクとて一瞬のうちに燃え尽きてしまうからな。しかし、敵が大気圏突入のために全神経を集中している今こそ、ザクで攻撃をするチャンスだ。第一目標、木馬。第二目標、敵のモビルスーツ。戦闘時間は２分とないはずだが、諸君らであればこの作戦を成し遂げられるであろう。期待する！', 0),
(2, 0, 'スレッガー・ロウ', 'g_armor@eesf.go.jp', 'ミライ少尉、人間若いときはいろんなことがあるけど、今の自分の気持ちをあんまり本気にしない方がいい。俺は少尉の好意を受けられるような男じゃない。オレに取っちゃあ、少尉は眩し過ぎるんだ。世界が違うんだな。安物なんだがね、お袋の形見なんだ。宇宙でなくしたら大変だ、預かっといてくれよ。', 0),
(3, 0, 'カス・ギレン・ザビ', 'giegzion@zion.go.rep', '国民よ！悲しみを怒りにかえて、立てよ！国民よ！我らジオン国国民こそ選ばれた民であることを忘れないでほしいのだ。優良種たる我らこそ人類を救い得るのである。我が忠勇なるジオン軍兵士たちよ。今や、地球連邦軍艦隊の半数が、我が、ソーラ・レイによって宇宙に消えた。この輝きこそ我らジオンの正義のあかしである。決定的打撃を受けた地球連邦軍に、いかほどの戦力が残っていようと、それは、すでに、形骸である。あえていおう、カスである！と。それら軟弱の集団が、このア・バオア・クーを抜くことはできないと、私は断言する。人類は、我ら選ばれた優良種たるジオン国国民に管理運営されて、初めて永久に生きのびることができる。これ以上戦いつづけては、人類そのものの存亡に関わるのだ。地球連邦の無能なるものどもに思い知らせ、明日の未来のために、我がジオン国国民は立たねばならぬのである！\r\nジーク・ジオン！', 0),
(4, 0, '聖帝サウザー', 'southerncross@nanto.com', '見ろこのガキを。シュウへの思いがこんなガキすら狂わす！！\r\n愛ゆえに人は苦しまねばならぬ！！\r\n愛ゆえに人は悲しまねばならぬ！！\r\n愛ゆえに・・', 0),
(5, 0, '煉獄杏寿郎', 'breath_of_flame@pillar.com', '胸を張って生きろ。己の弱さや不甲斐なさにどれだけ打ちのめされようと、心を燃やせ。歯を食いしばって前を向け。君が足を止めて蹲（うずくま）っても時間の流れは止まってくれない。共に寄り添って悲しんではくれない。俺がここで死ぬことは気にするな。柱ならば後輩の盾となるのは当然だ。柱ならば誰であっても同じことをする。若い芽は摘ませない。竈門少年、猪頭少年、黄色い少年、もっともっと成長しろ。そして今度は君たちが鬼殺隊を支える柱となるのだ。俺は信じる。君たちを信じる。', 0),
(6, 0, '串田　アキラ', 'gavan@space.detective.org', '男なんだろ？ぐずぐするなよ\r\n胸のエンジンに火をつけろ\r\nおれはここだぜ　ひと足お先\r\n光の速さで　あしたへダッシュさ\r\n若さ　若さってなんだ？　ふりむかないことさ\r\n愛ってなんだ？　ためらわないことさ\r\nギャバン！　あばよ過去\r\nギャバン！　よろしく未来\r\n宇宙刑事ギャバン！\r\n悪いやつらは　天使の顔して\r\n心で爪を　といでいるものさ\r\nおれもお前も　名もない花を\r\n踏みつけられない　男になるのさ\r\n若さ　若さってなんだ？　あきらめないことさ\r\n愛ってなんだ？　くやまないことさ\r\nギャバン！　あばよ過去\r\nギャバン！　よろしく未来\r\n宇宙刑事ギャバン！\r\n', 0),
(7, 0, 'ET-KING', 'sake_nomeru@sake.sake.sake', '一月は正月で酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n二月は豆まきで酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n三月はひな祭りで酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n四月は花見で酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n五月は子供の日で酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n六月は田植えで酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n七月は七夕で酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n八月は暑いから酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n九月は台風で酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n十月は運動会で酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n十一月は何でもないけど酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ\r\n十二月はドサクサで酒が飲めるぞ\r\n酒が飲める飲めるぞ酒が飲めるぞ', 0),
(8, 0, 'セイラ・マス', 'sayla_mass@eesf.wb.or.jp', 'やめなさい、アムロ！　やめなさい、兄さん！２人が戦うことなんてないのよ！　戦争だからって、２人が戦うことは。', 0),
(9, 0, 'ララァ・スン', 'lalah_sune@zion.or.zr', 'シャアをいじめる悪い人。', 0),
(10, 0, 'フラウ・ボゥ', 'fraw_bow@gundam.wb.eesf', 'ブライトさん、ア、アムロがあんな戦い方をしている。', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `contactdb`
--
ALTER TABLE `contactdb`
  ADD PRIMARY KEY (`contid`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `contactdb`
--
ALTER TABLE `contactdb`
  MODIFY `contid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
